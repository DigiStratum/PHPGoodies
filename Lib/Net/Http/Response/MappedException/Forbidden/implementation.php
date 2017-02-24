<?php
/**
 * PHPGoodies:Lib_Net_Http_Response_MappedException_Forbidden - Extension of SPL's RuntimeException
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
 * MappedException: 403 FORBIDDEN
 */
abstract class Lib_Net_Http_Response_MappedException_Forbidden extends Lib_Net_Http_Response_MappedException {

	/**
	 * Constructor - code is "fixed" for these mapped exceptions, so we don't allow code to be supplied
	 */
	public function __construct($message = '', $previous = null) {
		$msg = (strlen($message)) ? " - {$message}" : '';
		$code = Lib_Net_Http_Response::HTTP_FORBIDDEN;
		$desc = Lib_Net_Http_Response::getDescription($code);
		parent::__construct("{$desc}{$m}", $code, $previous);
	}
}

