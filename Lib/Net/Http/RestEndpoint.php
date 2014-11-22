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
	 * GET method handler for this endpoint
	 *
	 * @param object $requestInfo RequestInfo instance
	 *
	 * @return object HttpResponse instance or null if not implemented
	 */
	public function GET($requestInfo) {
		return null;
	}

	/**
	 * POST method handler for this endpoint
	 *
	 * @param object $requestInfo RequestInfo instance
	 *
	 * @return object HttpResponse instance or null if not implemented
	 */
	public function POST($requestInfo) {
		return null;
	}

	/**
	 * PUT method handler for this endpoint
	 *
	 * @param object $requestInfo RequestInfo instance
	 *
	 * @return object HttpResponse instance or null if not implemented
	 */
	public function PUT($requestInfo) {
		return null;
	}

	/**
	 * DELETE method handler for this endpoint
	 *
	 * @param object $requestInfo RequestInfo instance
	 *
	 * @return object HttpResponse instance or null if not implemented
	 */
	public function DELETE($requestInfo) {
		return null;
	}

	/**
	 * OPTIONS method handler for this endpoint
	 *
	 * @param object $requestInfo RequestInfo instance
	 *
	 * @return object HttpResponse instance or null if not implemented
	 */
	public function OPTIONS($requestInfo) {
		return null;
	}
}

