<?php
/**
 * PHPGoodies:Lib_Net_Http_Rest_Endpoint - Non-instantiable RESTful API endpoint base class
 *
 * @uses Lib_Net_Http_CorsPolicy
 * @uses Lib_Net_Http_Response
 * @uses Lib_Net_Http_Request
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Net.Http.CorsPolicy');
PHPGoodies::import('Lib.Net.Http.Request');

/**
 * Non-instantiable RESTful API endpoint base class
 */
abstract class Lib_Net_Http_Rest_Endpoint {

	/**
	 * The CorsPolicy for this endpoint
	 */
	protected $corsPolicy = null;

	/**
	 * Get the currently set CorsPolicy
	 *
	 * @return object Our current CorsPolicy, or null if there isn't one
	 */
	public function &getCorsPolicy() {
		return $this->corsPolicy;
	}

	/**
	 * Set a CorsPolicy for this REST endpoint
	 *
	 * @param object $corsPolicy an instance of CorsPolicy
	 *
	 * @return object $this for chaining aupport...
	 */
	public function setCorsPolicy($corsPolicy) {
		if (! $corsPolicy instanceof CorsPolicy) {
			throw new \Exception("Attempted to set something other than a CorsPolicy as the CORS Policy for a RESTful endpoint.");
		}
		$this->corsPolicy = $corsPolicy;
		return $this;
	}

	/**
	 * Check whether this endpoint has a CORS Policy set
	 *
	 * @return boolean true if there is a CorsPolicy, else false
	 */
	public function hasCorsPolicy() {
		return ($this->corsPolicy instanceof CorsPolicy);
	}

	/**
	 * Check whether the specified method is implemented for this endpoint
	 *
	 * Note that we are just going off public scope status since all these methods are protected
	 * by default, if one of them turns up public, it's because it is "implemented" and should 
	 * be accessible to the outside world.
	 *
	 * @param string $method One of GET|POST|PUT|DELETE|OPTIONS
	 *
	 * @return boolean true if the method is implemented for this endpoint, else false
	 */
	public function isImplemented($method) {
		if (! method_exists($this, $method)) return false;
		$ref = new \ReflectionMethod($this, $method);
		return $ref->isPublic();
	}

	/**
	 * GET method handler for this endpoint
	 *
	 * @param object $httpRequest HttpRequest instance
	 *
	 * @return object HttpResponse instance
	 */
	protected function get($httpRequest) {
		return $this->defaultResponse($httpRequest);
	}

	/**
	 * POST method handler for this endpoint
	 *
	 * @param object $httpRequest HttpRequest instance
	 *
	 * @return object HttpResponse instance
	 */
	protected function post($httpRequest) {
		return $this->defaultResponse($httpRequest);
	}

	/**
	 * PUT method handler for this endpoint
	 *
	 * @param object $httpRequest HttpRequest instance
	 *
	 * @return object HttpResponse instance
	 */
	protected function put($httpRequest) {
		return $this->defaultResponse($httpRequest);
	}

	/**
	 * DELETE method handler for this endpoint
	 *
	 * @param object $httpRequest HttpRequest instance
	 *
	 * @return object HttpResponse instance
	 */
	protected function delete($httpRequest) {
		return $this->defaultResponse($httpRequest);
	}

	/**
	 * OPTIONS method handler for this endpoint
	 *
	 * This one is public because it is likely to not need a custom implementation per API, just
	 * relying on a properly configured CorsPolicy to drive it. So this default implementation
	 * will what responds to most-to-all OPTIONS "pre-flight" requests.
	 *
	 * @todo What should we return for OPTIONS requests with no CORS policy?
	 *
	 * @param object $httpRequest HttpRequest instance (read only)
	 *
	 * @return object HttpResponse instance
	 */
	public function options(&$httpRequest) {
		return $this->defaultResponse($httpRequest);
	}

	/**
	 * Default baseline response for all methods for this endpoint
	 *
	 * Default implementation will handle CORS headers according to policy, but subclass may
	 * override with a custom implementation as needed.
	 *
	 * ref: https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS
	 *
	 * @todo Any other default headers we want to add into the response set?
	 *
	 * @param object $httpRequest HttpRequest instance (read only)
	 *
	 * @return object HttpResponse instance or null if not implemented
	 */
	protected function defaultResponse(&$httpRequest) {
		$httpResponse = PHPGoodies::instantiate('Lib.Net.Http.Response');
		$requestInfo = $httpRequest->getInfo();

		// If we have a CORS policy...
		if (! is_null($this->corsPolicy)) {

			// For OPTIONS requests...
			if ($requestInfo->method == 'OPTIONS') {

				// We want to look at ALL implemented methods for this endpoint
				$methods = array();
				foreach (Lib_Net_Http_Request::getRequestMethods() as $method) {

					// If we have a handler implementation for it here...
					if ($this->isImplemented($method)) {
						$methods[] = $method;
					}
				}
			}
			else {
				// Otherwise we just want a response for the one method requested
				$methods = array($requestInfo->method);
			}

			// Merge the CORS response headers in with our own
			$corsHeaders = $this->corsPolicy->getResponseHeaders($httpRequest, $methods);
			$httpResponse->headers->merge($corsHeaders);
		}

		return $httpResponse;
	}
}

