<?php
/**
 * PHPGoodies:RestEndpoint - Non-instantiable RESTful API endpoint base class
 *
 * @uses CorsPolicy
 * @uses HttpResponse
 * @uses HttpRequest
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Net.Http.CorsPolicy');
PHPGoodies::import('Lib.Net.Http.HttpRequest');

/**
 * Non-instantiable RESTful API endpoint base class
 */
abstract class RestEndpoint {

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
		$ref = new \ReflectionMethod($this, $method);
		return $ref->isPublic();
	}

	/**
	 * GET method handler for this endpoint
	 *
	 * @param object $httpRequest HttpRequest instance
	 *
	 * @return object HttpResponse instance or null if not implemented
	 */
	protected function get($httpRequest) {
		return null;
	}

	/**
	 * POST method handler for this endpoint
	 *
	 * @param object $httpRequest HttpRequest instance
	 *
	 * @return object HttpResponse instance or null if not implemented
	 */
	protected function post($httpRequest) {
		return null;
	}

	/**
	 * PUT method handler for this endpoint
	 *
	 * @param object $httpRequest HttpRequest instance
	 *
	 * @return object HttpResponse instance or null if not implemented
	 */
	protected function put($httpRequest) {
		return null;
	}

	/**
	 * DELETE method handler for this endpoint
	 *
	 * @param object $httpRequest HttpRequest instance
	 *
	 * @return object HttpResponse instance or null if not implemented
	 */
	protected function delete($httpRequest) {
		return null;
	}

	/**
	 * OPTIONS method handler for this endpoint
	 *
	 * Default implementation will handle CORS headers according to policy, but subclass may
	 * override with a custom implementation as needed.
	 *
	 * ref: https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS
	 *
	 * @param object $httpRequest HttpRequest instance
	 *
	 * @return object HttpResponse instance or null if not implemented
	 */
	public function options($httpRequest) {

		$requestInfo = $httpRequest->getInfo();

		$httpResponse = PHPGoodies::instantiate('Lib.Net.Http.HttpResponse');

		// Is there a CorsPolicy for this request method?
		if ($this->hasCorsPolicy()) {

			// Since there is a CorsPolicy in place, we will require that it explicitly
			// permit requests to whatever is being inquired about...

			// Did the requester ask about a specific method?
			if ($requestInfo->headers->has('Access-Control-Request-Method')) {
				$method = $requestInfo->headers->get('Access-Control-Request-Method');

				// Did the requester ask about any custom headers?
				if ($requestInfo->headers->has('Access-Control-Request-Headers')) {
					$requestHeaders = explode(',', $requestInfo->headers->get('Access-Control-Request-Headers'));
					$allowedHeaders = array();
					// For each requested custom header...
					foreach ($requestHeaders as $header) {

						// header gets trimmed because there may be whitespace in the supplied string
						if ($this->corsPolicy->doesMethodHaveHeader($method, trim($header))) {
							$allowedHeaders[] = trim($header);
						}
					}
					if (count($allowedHeaders)) {
						$httpResponse->headers->set('Access-Control-Allow-Headers', implode(', ', $allowedHeaders));
					}
				}
			}
			else $method = null;

			// Did the requester supply an origin?
			if ($requestInfo->headers->has('Origin')) {
				$origin = $requestInfo->headers->get('Origin');

				// Did the requester ask about a specific method?
				if (isset($method)) {
					if ($this->corsPolicy->doesMethodHaveOrigin($method, $origin)) {
						$allowedOrigin = $this->corsPolicy->getMatchingMethodOrigin($method, $origin);
						$httpResponse->headers->set('Access-Control-Allow-Origin', $allowedOrigin);
						$httpResponse->headers->set('Access-Control-Allow-Methods', strtoupper($method));
					}
				}
				else {
					// With no request method, all we can really do is give
					// the set of methods that are possible for this origin
					$allowedMethods = array();

					// For every possible request method...
					foreach (HttpRequest::getRequestMethods() as $method) {

						// If we have a handler implementation for it here...
						if ($this->isImplemented($method)) {

							// And the CorsPolicy allows it for this origin
							if ($this->corsPolicy->doesMethodHaveOrigin($method, $origin)) {
								$allowedMethods[] = $method;
							}
						}
					}
					$httpResponse->headers->set('Access-Control-Allow-Methods', implode(', ', $allowedMethods));
				}
			}
			else {
				// With no origin specified, all we can do is response with the set
				// of methods that are implemented...
				$implementedMethods = array();

				// For every possible request method...
				foreach (HttpRequest::getRequestMethods() as $method) {

					// If we have a handler implementation for it here...
					if ($this->isImplemented($method)) {
						$implementedMethods[] = $method;
					}
				}
				$httpResponse->headers->set('Access-Control-Allow-Methods', implode(', ', $implementedMethods));
			}

			// 30 mintues expiry on preflight info so we can change things without a long wait
			$httpResponse->headers->set('Access-Control-Max-Age', 1800);
		}
		else {
			// TODO: What should we return for OPTIONS requests with no CORS policy?
		}


		// TODO Any other default headers we want to add into the response set?

		// TODO support for authenticated requests

		return $httpResponse;
	}
}

