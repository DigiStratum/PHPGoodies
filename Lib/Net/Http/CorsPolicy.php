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
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Headers
 */
class CorsPolicy {

	protected $methodOrigins;

	public function __construct() {
		$this->methodOrigins = array(
			'DELETE' => null,
			'GET' => null,
			'HEAD' => null,
			'OPTIONS' => null,
			'POST' => null,
			'PUT' => null,
			'TRACE' => null
		);
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
	 * @param string $origin protocol://hostname:port
	 * @param string $method The method we want to associate the origin with
	 *
	 * @return object $this for chaining support...
	 */
	public function addMethodOrigin($origin, $method) {

		// If the requested method doesn't already have any origins
		if (! is_array($this->methodOrigins[$method])) {
			$this->methodOrigins[$method] = array();
		}

		// No effort is made to de-duplicate
		$this->methodOrigins[] = $origin;

		return $this;
	}

	public function checkOrigin($origin, $method) {
	}


	protected function isMethodSupported($method) {
		return isset($this->methodOrigins[$method]);
	}
}

