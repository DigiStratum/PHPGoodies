<?php
/**
 * PHPGoodies:String - Extends PHP's native/primitive string with OOP capabilities
 *
 * @todo Bring in code from the JavaPHP project (but dispense with the Java interface in favor of
 * something more sensible/streamlined.
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * String
 */
class String {

	/**
	 * The string value we'll be working with
	 */
	protected $str;

	/**
	 * Constructor
	 *
	 * @param mixed $str Native/primitive string value OR another String object to initialize with
	 */
	public function __construct($str) {
		$this->str = $this->mixedVal($str);
	}

	/**
	 * Get the native/primitive string value back out easily
	 *
	 * @return string The value of our string
	 */
	public function get() {
		return $this->str;
	}

	/**
	 * Get the string's character length
	 *
	 * @todo Determine and document behavior for multibyte character sets
	 *
	 * @return integer length of the string in chars
	 */
	public function len() {
		return strlen($this->str);
	}

	/**
	 * Is the supplied string equal to us?
	 *
	 * @param mixed $str Native/primitive string value OR another String object to use
	 *
	 * @return boolean true if the string is equl to us, else false
	 */
	public function equals($str) {
		return ($this->str ==  $this->mixedVal($str));
	}

	/**
	 * Get the value of either a native/primitive or OOP String
	 *
	 * With enforcement!
	 *
	 * @param mixed $str Native/primitive string value OR another String object to use
	 *
	 * @return string The value of the string either way
	 */
	protected function mixedVal($str) {
		return ($this->stringType($str) == 'string') ? $str : $str->get();
	}

	/**
	 * Is the argument a string (native/primitive) or String (object)?
	 *
	 * @param mixed $str Native/primitive string value OR another String object to use
	 *
	 * @return string Either 'string' or 'String', depending
	 */
	protected function stringType(&$str) {
		switch (gettype($str)) {
			case 'string': return 'string';
			case 'object': if (is_a($str, __CLASS__)) return 'String';
			default: throw new \Exception("Attempted to use a String with something other than a string ('" . gettype($str) . "'");
		}
	}
}

