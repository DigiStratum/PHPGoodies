<?php
/**
 * PHPGoodies:Lib_Net_Http_Response - An HTTP response container
 *
 * @uses Lib_Net_Http_Headers
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
class Lib_Net_Http_Response {

	// 1XX - INFORMATIONAL
	const HTTP_CONTINUE				= 100;
	const HTTP_SWITCHING_PROTOCOLS			= 101;

	// 2XX - SUCCESS
	const HTTP_OK					= 200;
	const HTTP_CREATED				= 201;
	const HTTP_ACCEPTED				= 202;
	const HTTP_NONAUTHORITATIVE_INFORMATION		= 203;
	const HTTP_NO_CONTENT				= 204;
	const HTTP_RESET_CONTENT			= 205;
	const HTTP_PARTIAL_CONTENT			= 206;
	const HTTP_IM_USED				= 226;

	// 3XX - REDIRECTION
	const HTTP_MULTIPLE_CHOICES			= 300;
	const HTTP_MOVED_PERMANENTLY			= 301;
	const HTTP_FOUND				= 302;
	const HTTP_SEE_OTHER				= 303;
	const HTTP_NOT_MODIFIED				= 304;
	const HTTP_USE_PROXY				= 305;
	const HTTP_TEMPORARY_REDIRECT			= 307;
	const HTTP_PERMANENT_REDIRECT			= 308;

	// 4XX - CLIENT ERROR
	const HTTP_BAD_REQUEST				= 400;
	const HTTP_UNAUTHORIZED				= 401;
	const HTTP_PAYMENT_REQUIRED			= 402;
	const HTTP_FORBIDDEN				= 403;
	const HTTP_NOT_FOUND				= 404;
	const HTTP_METHOD_NOT_ALLOWED			= 405;
	const HTTP_NOT_ACCEPTABLE			= 406;
	const HTTP_PROXY_AUTHENTICATION_REQUIRED	= 407;
	const HTTP_REQUEST_TIMEOUT			= 408;
	const HTTP_CONFLICT				= 409;
	const HTTP_GONE					= 410;
	const HTTP_LENGTH_REQUIRED			= 411;
	const HTTP_PRECONDITION_FAILED			= 412;
	const HTTP_REQUEST_ENTITY_TOO_LARGER		= 413;
	const HTTP_REQUEST_URI_TOO_LONG			= 414;
	const HTTP_UNSUPPORTED_MEDIA_TYPE		= 415;
	const HTTP_REQUESTED_RANGE_NOT_SATISFIABLE	= 416;
	const HTTP_EXPECTATION_FAILED			= 417;
	const HTTP_UPGRADE_REQUIRED			= 426;
	const HTTP_PRECONDITION_REQUIRED		= 428;
	const HTTP_TOO_MANY_REQUESTS			= 429;

	// 5XX - SERVER ERROR
	const HTTP_INTERNAL_SERVER_ERROR		= 500;
	const HTTP_NOT_IMPLEMENTED			= 501;
	const HTTP_BAD_GATEWAY				= 502;
	const HTTP_SERVICE_UNAVAILABLE			= 503;
	const HTTP_GATEWAY_TIMEOUT			= 504;
	const HTTP_VERSION_NOT_SUPPORTED		= 505;
	const HTTP_VARIANT_ALSO_NEGOTIATES		= 506;
	const HTTP_BANDWIDTH_LIMIT_EXCEEDED		= 509;
	const HTTP_NOT_EXTENDED				= 510;
	const HTTP_NETWORK_AUTHENICATION_REQUIRED	= 511;
	const HTTP_NETWORK_READ_TIMEOUT_ERROR		= 598;
	const HTTP_NETWORK_CONNECT_TIMEOUT_ERROR	= 599;

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
	public $body = null;

	/**
	 * HTTP code for this response
	 */
	public $code = self::HTTP_OK;

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

	/**
	 * Reset the response data for use/reuse
	 */
	public function reset() {
		$this->body = null;
		$this->headers->nil();
	}

	/**
	 * Set the HTTP status code
	 *
	 * @param $code integer HTTP status code value; should be one of our constants
	 *
	 * @return object $this for chainable support...
	 */
	public function setCode($code) {
		$this->code = $code;
		$this->headers->set("HTTP/1.1 {$code} {$this->getDescription($code)}");
		return $this;
	}

	/**
	 * Set the response body
	 *
	 * @param $body string of raw response body
	 *
	 * @return object $this for chainable support...
	 */
	public function setResponseBody($body) {
		$this->code = $body;
		return $this;
	}

	/**
	 * Get the short description for the given HTTP response code
	 */
	protected function getDescription($code) {
		switch ($code) {
			case HTTP_OK: return 'OK';
			case HTTP_CREATED: return 'CREATED';
			case HTTP_ACCEPTED: return 'ACCEPTED';
			case HTTP_NONAUTHORITATIVE_INFORMATION: return 'NONAUTHORITATIVE INFORMATION';
			case HTTP_NO_CONTENT: return 'NO CONTENT';
			case HTTP_RESET_CONTENT: return 'RESET CONTENT';
			case HTTP_PARTIAL_CONTENT: return 'PARTIAL CONTENT';
			case HTTP_IM_USED: return 'IM USED';
			case HTTP_MULTIPLE_CHOICES: return 'MULTIPLE CHOICES';
			case HTTP_MOVED_PERMANENTLY: return 'MOVED PERMANENTLY';
			case HTTP_FOUND: return 'FOUND';
			case HTTP_SEE_OTHER: return 'SEE OTHER';
			case HTTP_NOT_MODIFIED: return 'NOT MODIFIED';
			case HTTP_USE_PROXY: return 'USE PROXY';
			case HTTP_TEMPORARY_REDIRECT: return 'TEMPORARY REDIRECT';
			case HTTP_PERMANENT_REDIRECT: return 'PERMANENT REDIRECT';
			case HTTP_BAD_REQUEST: return 'BAD REQUEST';
			case HTTP_UNAUTHORIZED: return 'UNAUTHORIZED';
			case HTTP_PAYMENT_REQUIRED: return 'PAYMENT REQUIRED';
			case HTTP_FORBIDDEN: return 'FORBIDDEN';
			case HTTP_NOT_FOUND: return 'NOT FOUND';
			case HTTP_METHOD_NOT_ALLOWED: return 'METHOD NOT ALLOWED';
			case HTTP_NOT_ACCEPTABLE: return 'NOT ACCEPTABLE';
			case HTTP_PROXY_AUTHENTICATION_REQUIRED: return 'PROXY AUTHENTICATION REQUIRED';
			case HTTP_REQUEST_TIMEOUT: return 'REQUEST TIMEOUT';
			case HTTP_CONFLICT: return 'CONFLICT';
			case HTTP_GONE: return 'GONE';
			case HTTP_LENGTH_REQUIRED: return 'LENGTH REQUIRED';
			case HTTP_PRECONDITION_FAILED: return 'PRECONDITION FAILED';
			case HTTP_REQUEST_ENTITY_TOO_LARGER: return 'REQUEST ENTITY TOO LARGE';
			case HTTP_REQUEST_URI_TOO_LONG: return 'REQUEST URI TOO LONG';
			case HTTP_UNSUPPORTED_MEDIA_TYPE: return 'UNSUPPORTED MEDIA TYPE';
			case HTTP_REQUESTED_RANGE_NOT_SATISFIABLE: return 'REQUESTED RANGE NOT SATISFIABLE';
			case HTTP_EXPECTATION_FAILED: return 'EXPECTATION FAILED';
			case HTTP_UPGRADE_REQUIRED: return 'UPGRADE REQUIRED';
			case HTTP_PRECONDITION_REQUIRED: return 'PRECONDITION REQUIRED';
			case HTTP_TOO_MANY_REQUESTS: return 'TOO MANY REQUESTS';
			case HTTP_INTERNAL_SERVER_ERROR: return 'INTERNAL SERVER ERROR';
			case HTTP_NOT_IMPLEMENTED: return 'NOT IMPLEMENTED';
			case HTTP_BAD_GATEWAY: return 'BAD GATEWAY';
			case HTTP_SERVICE_UNAVAILABLE: return 'HTTP SERVICE UNAVAILABLE';
			case HTTP_GATEWAY_TIMEOUT: return 'GATEWAY TIMEOUT';
			case HTTP_VERSION_NOT_SUPPORTED: return 'VERSION NOT SUPPORTED';
			case HTTP_VARIANT_ALSO_NEGOTIATES: return 'VARIANT ALSO NEGOTIATES';
			case HTTP_BANDWIDTH_LIMIT_EXCEEDED: return 'BANDWIDTH LIMIT EXCEEDED';
			case HTTP_NOT_EXTENDED: return 'NOT EXTENDED';
			case HTTP_NETWORK_AUTHENICATION_REQUIRED: return 'NETWORK AUTHENTICATION REQUIRED';
			case HTTP_NETWORK_READ_TIMEOUT_ERROR: return 'NETWORK READ TIMEOUT ERROR';
			case HTTP_NETWORK_CONNECT_TIMEOUT_ERROR: return 'NETWORK CONNECT TIMEOUT ERROR';
		}
		return 'UNKNOWN CODE';
	}
}

