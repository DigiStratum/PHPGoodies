<?php
/**
 * PHPGoodies:CorsPolicy - A policy of CORS requirements for a specific URI
 *
 * Cross-Origin Resource Sharing... we want to provide appropriate CORS headers for this combination
 * of URI, request method, and origin (protocol://hostname:port). This policy class lets us cleanly
 * define the CORS requirements for the endpoint and subsequently query the policy for a specific
 * scenario.
 *
 * All methods supported by HTTP1.1, RFC2616, http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html,
 * are supported (not just those commonly used by REST interfaces).
 *
 * Note that all method names are indexed in all CAPS as array indexes regardless of what is passed
 * to the method calls to ensure that they will always be found.
 *
 * @uses HttpRequest
 * @uses HttpHeaders
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Net.Http.HttpRequest');
PHPGoodies::import('Lib.Net.Http.HttpHeaders');

/**
 * CorsPolicy
 */
class CorsPolicy {

	/**
	 * The set of origins for each method for which CORS header(s) should be provided
	 */
	protected $methodOrigins;

	/**
	 * The set of atypical headers that each method is prepared to receive
	 */
	protected $methodHeaders;

	/**
	 * Constructor
	 *
	 * Prepares the set of method origins with all the methods and no origins
	 */
	public function __construct() {
		$this->methodOrigins = $this->methodHeaders = array();
		foreach (HttpRequest::getRequestMethods() as $method) {
			$this->methodOrigins[$method] = null;
			$this->methodHeaders[$method] = null;
		}
	}

	/**
	 * Add an origin to each of the specified methods
	 *
	 * @param string $origin protocol://hostname:port
	 * @param array $methodList List of strings with method identifiers to connect to origin
	 *
	 * @return object $this for chaining support...
	 */
	public function addOrigin($origin, $methodList) {
		if (! (is_array($methodList) && count($methodList))) return $this;
		foreach ($methodList as $method) {

			// If the requested method isn't even a supported one, skip it
			if (! $this->isMethodSupported($method)) continue;

			// Add the origin to this method
			$this->addMethodOrigin($origin, $method);
		}

		return $this;
	}

	/**
	 * Add an origin to the specified method
	 *
	 * @param string $method The method we want to associate the origin with
	 * @param string $origin protocol://hostname:port
	 *
	 * @return object $this for chaining support...
	 */
	public function addMethodOrigin($method, $origin) {
		$this->requireSupportedMethod($method);

		// If the requested method doesn't already have any origins
		if (! is_array($this->methodOrigins[strtoupper($method)])) {
			$this->methodOrigins[strtoupper($method)] = array();
		}

		// No effort is made to de-duplicate
		$this->methodOrigins[strtoupper($method)][] = $origin;

		return $this;
	}

	/**
	 * Adds an atypical request header to a method so that the CORS response may reflect it
	 *
	 * @param string $method The method we want to associate the header with
	 * @param string $header The name of a header we want requesters to be able to send here
	 *
	 * @return object $this for chaining support...
	 */
	public function addMethodHeader($method, $header) {
		$this->requireSupportedMethod($method);

		// If the requested method doesn't already have any headers...
		if (! is_array($this->methodHeader[strtoupper($method)])) {
			$this->methodHeader[strtoupper($method)] = array();
		}

		// No effort is made to de-duplicate
		$this->methodHeader[strtoupper($method)][] = HttpHeaders::properName($header);

		return $this;
	}

	/**
	 * Check if the method has the specified origin added to it
	 *
	 * @param string $method The method we want to check
	 * @param string $origin protocol://hostname:port
	 *
	 * @return boolean true if the method has the specified origin, else false
	 */
	public function doesMethodHaveOrigin($method, $origin) {
		return is_null($tihs->getMatchingMethodOrigin($method, $origin)) ? false : true;	
	}

	/**
	 * Get the matching methodOrigin for the requested method/origin (if any)
	 *
	 * The catch here is that we are suposed to support wildcards; so we will convert all the
	 * origins that we have stored for this method into regex matching patterns, and try to
	 * match them each in turn with the origin supplied.
	 *
	 * What we will return is the methodOrigin that we have who matches the requested origin
	 * (the first one that we hit in the even that there are multiple potential matches) so
	 * if, for example, we have a methodOrigin of '*' in the policy and the requested origin
	 * is like 'yoursite.com', '*' will be returned because that is what matched.
	 *
	 * @param string $method The method we want to check
	 * @param string $origin protocol://hostname:port
	 *
	 * @return string The methodOrigin that matched, or null if none
	 */
	public function getMatchingMethodOrigin($method, $origin) {
		$this->requireSupportedMethod($method);
		if (! is_array($this->methodOrigins[strtoupper($method)])) return null;
		foreach ($this->methodOrigins[$method] as $methodOrigin) {
			$pattern = str_replace('*', '(.*?)', $methodOrigin);
			if (preg_match("/{$pattern}/", $origin)) return $methodOrigin;
		}
		return null;
	}

	/**
	 * Simple check for whether the method supports this specific header
	 *
	 * @param string $method The method we want to check
	 * @param string $header The name of a header we want to check
	 *
	 * @return boolean true if the method supports this header, else false
	 */
	public function doesMethodHaveHeader($method, $header) {
		$this->requireSupportedMethod($method);
		if (! is_array($this->methodHeaders[strtoupper($method)])) return false;
		return in_array(HttpHeaders::properName($header), $this->methodHeaders[strtoupper($method)]);
	}

	/**
	 * Get the whole set of headers supported by this method
	 *
	 * @param string $method The method we want to check
	 *
	 * @return array Of strings where each is the name of an atypical header supported
	 */
	public function getMethodHeaders($method) {
		$this->requireSupportedMethod($method);
		return is_array($this->methodHeaders[strtoupper($method)]) ? $this->methodHeaders[strtoupper($method)] : array();
	}

	/**
	 * Check whether the specified method is supported
	 *
	 * @param string $method The method we want to check (case insinsitive)
	 *
	 * @return boolean true if the method is supported, else false
	 */
	public function isMethodSupported($method) {
		return (in_array(strtoupper($method), array_keys($this->methodOrigins)));
	}

	/**
	 * Caller forces specified method to be supported or throw exception (boilerplate reduction)
	 *
	 * @param string $method The method we want to check
	 */
	protected function requireSupportedMethod($method) {

		// If the requested method is unsupported...
		if (! $this->isMethodSupported($method)) {
			throw new \Exception("Attempt to set CORS Policy on an unsupported method ({$method})");
		}
	}
}

