<?php
/**
 * PHPGoodies:RestEndpoint - Non-instantiable RESTful API endpoint base class
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Non-instantiable RESTful API endpoint base class
 */
abstract class RestEndpoint {

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
	 * @param object $requestInfo RequestInfo instance
	 *
	 * @return object HttpResponse instance or null if not implemented
	 */
	protected function get($requestInfo) {
		return null;
	}

	/**
	 * POST method handler for this endpoint
	 *
	 * @param object $requestInfo RequestInfo instance
	 *
	 * @return object HttpResponse instance or null if not implemented
	 */
	protected function post($requestInfo) {
		return null;
	}

	/**
	 * PUT method handler for this endpoint
	 *
	 * @param object $requestInfo RequestInfo instance
	 *
	 * @return object HttpResponse instance or null if not implemented
	 */
	protected function put($requestInfo) {
		return null;
	}

	/**
	 * DELETE method handler for this endpoint
	 *
	 * @param object $requestInfo RequestInfo instance
	 *
	 * @return object HttpResponse instance or null if not implemented
	 */
	protected function delete($requestInfo) {
		return null;
	}

	/**
	 * OPTIONS method handler for this endpoint
	 *
	 * @param object $requestInfo RequestInfo instance
	 *
	 * @return object HttpResponse instance or null if not implemented
	 */
	protected function options($requestInfo) {
		return null;
	}
}

