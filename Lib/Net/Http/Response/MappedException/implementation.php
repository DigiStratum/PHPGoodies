<?php
/**
 * PHPGoodies:Lib_Net_Http_Response_MappedException - Extension of SPL's RuntimeException
 *
 * The "Mapped" aspect of this class of exceptions enables each subclass to map a specific HTTP
 * status code to the exception class. Then, whenever whoever receives one of these mapped
 * exceptions during the course of handling a given HTTP request... can response with the mapped
 * status code without having to think about it too much. This pushes the responsibility of the
 * mapping to a deeper level of the code so that all the exceptions may be handled uniformly
 * higher up the stack.
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Extension of SPL's RuntimeException
 */
abstract class Lib_Net_Http_Response_MappedException extends \RuntimeException {

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

