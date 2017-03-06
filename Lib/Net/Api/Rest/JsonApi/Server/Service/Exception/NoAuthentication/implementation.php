<?php
/**
 * PHPGoodies:Lib_Net_Api_Rest_JsonApi_Server_Exception_NoAuthentication
 *
 * Throw one of these whenever some request is being made without required authentication
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Extension of SPL's LogicException
 */
class Lib_Net_Api_Rest_JsonApi_Server_Service_Exception_NoAuthentication extends \RuntimeException {

	/**
	 * Constructor
	 */
	public function __construct($message, $code = 0, $previous = null) {
		parent::__construct($message, $code, $previous);
	}

	/**
	 * Get a custom string representation of object
	 *
	 * @return string custom string representation of object
	 */
	public function __toString() {
		return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
	}
}

