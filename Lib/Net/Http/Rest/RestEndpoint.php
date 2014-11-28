<?php
/**
 * PHPGoodies:RestEndpoint - Non-instantiable RESTful API endpoint base class
 *
 * @uses CorsPolicy
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Net.Http.CorsPolicy');

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
	 * @param object $httpRequest HttpRequest instance
	 *
	 * @return object HttpResponse instance or null if not implemented
	 */
	protected function options($httpRequest) {
		return null;
	}
}

