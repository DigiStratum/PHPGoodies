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
 * @uses Collection
 * @uses String
 * @uses HttpRequest
 * @uses HttpHeaders
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Data.String');
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
	 * Prepares the set of method policies for all methods
	 */
	public function __construct($methods = array()) {

		$this->methodPolicies = array();

		foreach ($methods as $index => $value) {
			$methods[$index] = strtoupper($value);
		}

		// For every valid HTTP request method...
		foreach (HttpRequest::getRequestMethods() as $method) {
			if (in_array($method, $methods)) {
				$this->methodPolicies[$method] = $this->methodPolicyFactory();
			}
			else $this->methodPolicies[$method] = null;
		}

		// And ALL origins are allowed for OPTIONS method
		if (! isset($this->methodPolicies['OPTIONS'])) {
			$this->methodPolicies['OPTIONS'] = $this->methodPolicyFactory();
		}
		$this->addOrigin('OPTIONS', '*');
	}

	// ORIGINS

	/**
	 * Allow an origin to each of the specified methods
	 *
	 * @param string $origin protocol://hostname:port
	 * @param array $methodList List of strings with method identifiers to connect to origin
	 *
	 * @return object $this for chaining support...
	 */
	public function allowOriginForMany($origin, $methodList) {
		if (! (is_array($methodList) && count($methodList))) return $this;
		foreach ($methodList as $method) {

			// If the requested method isn't even a supported one, skip it quietly
			if (! $this->isMethodSupported($method)) continue;

			// Add the origin to this method
			$this->addOrigin($method, $origin);
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
	public function addOrigin($method, $origin) {
		$this->requireSupportedMethod($method);
		$this->methodPolicies[strtoupper($method)]->allowedOrigins->add(new String($origin));
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
	public function hasOrigin($method, $origin) {
		return is_null($this->getMatchingOrigin($method, $origin)) ? false : true;	
	}

	/**
	 * Get the matching methodOrigin for the requested method/origin (if any)
	 *
	 * If we have a methodOrigin of '*' in the policy and the requested origin is like
	 * 'yoursite.com', '*' will be returned because that is what matched.
	 *
	 * @param string $method The method we want to check
	 * @param string $origin protocol://hostname:port
	 *
	 * @return string The methodOrigin that matched, or null if none
	 */
	public function getMatchingOrigin($method, $origin) {
		$this->requireSupportedMethod($method);
		// Special support for wildcard
		$any =& $this->methodPolicies[strtoupper($method)]->allowedOrigins->find('get', '*');
		if (! is_null($any)) return '*';
		$match =& $this->methodPolicies[strtoupper($method)]->allowedOrigins->find('get', $origin);
		return is_null($match) ? null : $match->get();
	}

	/**
	 * Get the whole set of origins supported by this method
	 *
	 * @param string $method The method we want to check
	 *
	 * @return array Of strings where each is one of the origins supported by the method
	 */
	public function getOrigins($method) {
		$this->requireSupportedMethod($method);
		return $this->methodPolicies[strtoupper($method)]->allowedOrigins->pluck('get');
	}

	// HEADERS

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
	public function addHeader($method, $header) {
		$this->requireSupportedMethod($method);
		$this->methodPolicies[strtoupper($method)]->allowedHeaders->add(new String(HttpHeaders::properName($header)));
		return $this;
	}

	/**
	 * Simple check for whether the method supports this specific header
	 *
	 * @param string $method The method we want to check
	 * @param string $header The name of a header we want to check
	 *
	 * @return boolean true if the method supports this header, else false
	 */
	public function hasHeader($method, $header) {
		$this->requireSupportedMethod($method);
		return $this->methodPolicies[strtoupper($method)]->allowedHeaders->hasWith('get', HttpHeaders::properName($header));
	}

	/**
	 * Get the whole set of headers supported by this method
	 *
	 * @param string $method The method we want to check
	 *
	 * @return array Of strings where each is the name of an atypical header supported
	 */
	public function getHeaders($method) {
		$this->requireSupportedMethod($method);
		return $this->methodPolicies[strtoupper($method)]->allowedHeaders->pluck('get');
	}

	// CREDENTIALS

	/**
	 * Check if credentials are required for this method
	 *
	 * @param string $method The method we want to check the credentials policy for
	 *
	 * @return boolean true if credentials are required, else false
	 */
	public function credentialsRequired($method) {
		$this->requireSupportedMethod($method);
		return ($this->methodPolicies[strtoupper($method)]->credentials == self::CREDENTIALS_REQUIRED);
	}

	/**
	 * Check if credentials are disabled for this method
	 *
	 * @param string $method The method we want to check the credentials policy for
	 *
	 * @return boolean true if credentials are disabled, else false
	 */
	public function credentialsDisabled($method) {
		$this->requireSupportedMethod($method);
		return ($this->methodPolicies[strtoupper($method)]->credentials == self::CREDENTIALS_DISABLED);
	}

	/**
	 * Disable credentials from being passed to the specified method
	 *
	 * @param string $method The method we want to disable credentials for
	 *
	 * @return object $this for chaining support...
	 */
	public function disableCredentials($method) {
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
	public function allowCredentials($method) {
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
	public function requireCredentials($method) {
		$this->requireSupportedMethod($method);
		$this->methodPolicies[strtoupper($method)]->credentials = self::CREDENTIALS_REQUIRED;
		return $this;
	}

	// GENERAL

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
	 * Get the response headers in the context of the supplied HttpRequest
	 *
	 * @param object $httpRequest An HttpRequest instance that we will respond to
	 * @param array $methods A list of methods that are valid for the requested endpoint
	 *
	 * @return object HttpHeaders instance
	 */
	public function getResponseHeaders($httpRequest, $methods) {
		$responseHeaders = PHPGoodies::instantiate('Lib.Net.Http.HttpHeaders');

		$requestInfo = $httpRequest->getInfo();

		$origin = $requestInfo->headers->has('Origin') ? $requestInfo->headers->get('Origin') : null;

		// OPTIONS requests are checked for preflight/CORS headers...
		if (strtoupper($requestInfo->method) == 'OPTIONS') {

			// Did the requester ask about a specific method?
			if ($requestInfo->headers->has('Access-Control-Request-Method')) {

				// This indicates the requester is running a preflight check
				$method = strtoupper($requestInfo->headers->get('Access-Control-Request-Method'));

				// Did the requester ask about any custom headers?
				if ($requestInfo->headers->has('Access-Control-Request-Headers')) {
					$requestHeaders = explode(',', $requestInfo->headers->get('Access-Control-Request-Headers'));
					$allowedHeaders = array();
					// For each requested custom header...
					foreach ($requestHeaders as $header) {

						// header gets trimmed because there may be whitespace in the supplied string
						if ($this->hasHeader($method, trim($header))) {
							$allowedHeaders[] = trim($header);
						}
					}
					if (count($allowedHeaders)) {
						$responseHeaders->set('Access-Control-Allow-Headers', implode(', ', $allowedHeaders));
					}
				}

				// Which methods are allowed for this origin
				if (! is_null($origin)) {
					$allowedMethods = array();

					// For every possible request method...
					foreach ($methods as $possibleMethod) {

						// ... and the CorsPolicy allows it for this origin...
						if ($this->hasOrigin($possibleMethod, $origin)) {
							$allowedMethods[] = $possibleMethod;
						}
					}
					$responseHeaders->set('Access-Control-Allow-Methods', implode(', ', $allowedMethods));
				}

				// 30 mintues expiry on preflight info so we can change things without a long wait
				$responseHeaders->set('Access-Control-Max-Age', 1800);

				// TODO support for authenticated requests
			}
			else {
				// Nothing special to do for non-preflight OPTIONS requests... (?)
			}
		}
		else {
			$method = strtoupper($requestInfo->method);
		}

		// Did the requester supply an origin?
		if (! is_null($origin)) {
			$allowedOrigin = $this->getMatchingOrigin($method, $origin);
			if (! is_null($allowedOrigin)) {
				$responseHeaders->set('Access-Control-Allow-Origin', $allowedOrigin);
			}
		}

		return $responseHeaders;
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
		$methodPolicy->allowedOrigins = PHPGoodies::instantiate('Lib.Data.Collection', 'String');

		// The set of atypical headers that each method is prepared to receive
		$methodPolicy->allowedHeaders = PHPGoodies::instantiate('Lib.Data.Collection', 'String');

		// Credentialed requests may be disabled (ignored), allowed, or required
		$methodPolicy->credentials = self::CREDENTIALS_DISABLED;

		return $methodPolicy;
	}
}

