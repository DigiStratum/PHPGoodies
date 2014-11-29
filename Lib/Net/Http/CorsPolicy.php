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

	const CREDENTIALS_DISABLED		= 0;
	const CREDENTIALS_ALLOWED		= 1;
	const CREDENTIALS_REQUIRED		= 2;

	/**
	 * The set of policy data for each request method of this endpoint
	 */
	protected $methodPolicies;

	/**
	 * Constructor
	 *
	 * Prepares the set of method origins with all the methods and no origins
	 */
	public function __construct() {

		$this->methodPolicies = array();

		// For every valid HTTP request method...
		foreach (HttpRequest::getRequestMethods() as $method) {
			$this->methodPolicies[$method] = null;
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

			// If the requested method isn't even a supported one, skip it quietly
			if (! $this->isMethodSupported($method)) continue;

			// Add the origin to this method
			$this->addMethodOrigin($method, $origin);
		}

		return $this;
	}

	/**
	 * Add an origin to the specified method
	 *
	 * No effort is made to de-duplicate
	 *
	 * @param string $method The method we want to associate the origin with
	 * @param string $origin protocol://hostname:port
	 *
	 * @return object $this for chaining support...
	 */
	public function addMethodOrigin($method, $origin) {
		$this->requireSupportedMethod($method);
		$this->methodPolicies[strtoupper($method)]->origins[] = $origin;
		return $this;
	}

	/**
	 * Adds an atypical request header to a method so that the CORS response may reflect it
	 *
	 * No effort is made to de-duplicate
	 *
	 * @param string $method The method we want to associate the header with
	 * @param string $header The name of a header we want requesters to be able to send here
	 *
	 * @return object $this for chaining support...
	 */
	public function addMethodHeader($method, $header) {
		$this->requireSupportedMethod($method);
		$this->methodPolicies[$method]->headers[] = HttpHeaders::properName($header);
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
		foreach ($this->methodPolicies[strtoupper($method)]->origins as $methodOrigin) {
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
		return in_array(HttpHeaders::properName($header), $this->methodPolicies[strtoupper($method)]->headers);
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
		return $this->methodPolicies[strtoupper($method)]->headers;
	}

	/**
	 * Get the whole set of origins supported by this method
	 *
	 * @param string $method The method we want to check
	 *
	 * @return array Of strings where each is one of the origins supported by the method
	 */
	public function getMethodOrigins($method) {
		$this->requireSupportedMethod($method);
		return $this->methodPolicies[strtoupper($method)]->origins;
	}

	/**
	 * Check whether the specified method is supported
	 *
	 * @param string $method The method we want to check (case insinsitive)
	 *
	 * @return boolean true if the method is supported, else false
	 */
	public function isMethodSupported($method) {
		return (in_array(strtoupper($method), array_keys($this->methodPolicies)));
	}

	/**
	 * Get the credentials policy for the specified method
	 *
	 * @param string $method The method we want to check the credentials policy for
	 *
	 * @return integer One of the CREDENTIALS_* constants representing the policy state
	 */
	public function getMethodCredentialsPolicy($method) {
		$this->requireSupportedMethod($method);
		return $this->methodPolicies[strtoupper($method)]->credentials;
	}

	/**
	 * Disable credentials from being passed to the specified method
	 *
	 * @param string $method The method we want to disable credentials for
	 *
	 * @return object $this for chaining support...
	 */
	public function disableMethodCredentials($method) {
		$this->requireSupportedMethod($method);
		$this->methodPolicies[strtoupper($method)]->credentials = self::CREDENTIALS_DISABLED;
		return $this;
	}

	/**
	 * Allow credentials to be passed to the specified method
	 *
	 * @param string $method The method we want to allow credentials for
	 *
	 * @return object $this for chaining support...
	 */
	public function allowMethodCredentials($method) {
		$this->requireSupportedMethod($method);
		$this->methodPolicies[strtoupper($method)]->credentials = self::CREDENTIALS_ALLOWED;
		return $this;
	}

	/**
	 * Require credentials to be passed to the specified method
	 *
	 * @param string $method The method we want to require credentials for
	 *
	 * @return object $this for chaining support...
	 */
	public function requireMethodCredentials($method) {
		$this->requireSupportedMethod($method);
		$this->methodPolicies[strtoupper($method)]->credentials = self::CREDENTIALS_REQUIRED;
		return $this;
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

	/**
	 * Factory method to produce a policy object for a given request method of this URI
	 *
	 * @return object stdClass instance with all properties needed for a method's CORS Policy
	 */
	protected function methodPolicyFactory() {
		$methodPolicy = new \stdClass();

		// The set of origins for each method for which CORS header(s) should be provided
		$methodPolicy->origins = array();

		// The set of atypical headers that each method is prepared to receive
		$methodPolicy->headers = array();

		// Credentialed requests may be disabled (ignored), allowed, or required
		$methodPolicy->credentials = self::CREDENTIALS_DISABLED;

		return $methodPolicy;
	}
}

