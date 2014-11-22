<?php
/**
 * PHPGoodies:HttpResponse - An HTTP response container
 *
 * @uses Headers
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * HTTP response container
 *
 * Note that we have gone full public access with the properties of the HttpRespeonse class
 * because they are simply convenience wrappers to carry multiple bits of data with them as we pass
 * them around. Any logic necessary will be wrapped into the control layers of the data/objects that
 * they wrap which is adequate functional protection for them, and any additions to them in the
 * future should be limited to adding other data properties as they are found to be useful without
 * the need to apply accessor methods short of some sort of macro/conversion/repackaging functions
 * that have utility value, but which are non-vital to the use of the class overall.
 *
 * @todo Make body and code objects like headers so that they are non-primitives with their own
 * control layer?
 */
class HttpResponse {

	/**
	 * Any headers we want to add to the output will be added here
	 */
	public $headers;

	/**
	 * Mimetype for this response
	 *
	 * @todo - Do we need this? It's really a header...
	 */
	public $mimetype = 'text/plain';

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

	/**
	 * Convenience method for subclasses to manipulate the response body as needed
	 *
	 * @return string The body text for the response
	 */
	public function getResponseBody() {
		return $this->body;
	}
}

