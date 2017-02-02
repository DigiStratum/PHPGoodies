<?php
/**
 * PHPGoodies:Oop_Exception_DataAccess - Extension of SPL's LogicException
 *
 * ref: http://php.net/manual/en/language.exceptions.extending.php
 * ref: http://php.net/manual/en/spl.exceptions.php
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Extension of SPL's LogicException
 */
class Oop_Exception_DataAccess extends \LogicException {

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

