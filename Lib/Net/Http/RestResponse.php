<?php
/**
 * PHPGoodies:RestResponse - RESTful API response container
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * RESTful API response container
 */
class RestResponse {

	/**
	 * Any headers we want to add to the output will be added here
	 */
	public $headers;

	/**
	 * Mimetype for this response
	 */
	public $mimetype = 'application/json';

	/**
	 * Body for this response
	 */
	public $body = '';

	/**
	 * HTTP code for this response
	 */
	public $code = 200;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->headers = PHPGoodies::instantiate('Lib.Net.Http.Headers');
	}
}

