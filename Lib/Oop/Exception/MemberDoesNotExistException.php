<?php
/**
 * PHPGoodies:MemberDoesNotExistException - Extension of SPL's LogicException
 *
 * ref: http://php.net/manual/en/language.exceptions.extending.php
 * ref: http://php.net/manual/en/spl.exceptions.php
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Oop.Exception.DataAccessException');

/**
 * Extension of SPL's LogicException
 */
class MemberDoesNotExistException extends DataAccessException {

	/**
	 * Constructor
	 */
	public function __construct($message, $code = 0, Exception $previous = null) {
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

