<?php
/**
 * PHPGoodies:Lib_Net_Http_Response_MappedException_BadRequest - Extension of SPL's RuntimeException
 *
 * @uses Lib_Net_Http_Response
 * @uses Lib_Net_Http_Response_MappedException
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Net.Http.Response');
PHPGoodies::import('Lib.Net.Http.Response.MappedException');

/**
 * MappedException: 400 BAD REQUEST
 */
class Lib_Net_Http_Response_MappedException_BadRequest extends Lib_Net_Http_Response_MappedException {

	/**
	 * Constructor - code is "fixed" for these mapped exceptions, so we don't allow code to be supplied
	 */
	public function __construct($message = '', $previous = null) {
		$msg = (strlen($message)) ? " - {$message}" : '';
		$code = Lib_Net_Http_Response::HTTP_BAD_REQUEST;
		$desc = Lib_Net_Http_Response::getDescription($code);
		parent::__construct("{$desc}{$msg}", $code, $previous);
	}
}

