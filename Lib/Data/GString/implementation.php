<?php
/**
 * PHPGoodies:GString - Extends PHP's native/primitive string with OOP capabilities
 *
 * @todo Bring in code from the JavaPHP project (but dispense with the Java interface in favor of
 * something more sensible/streamlined.
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * GString
 */
class GString {

	/**
	 * The string value we'll be working with
	 */
	protected $str;

	/**
	 * Constructor
	 *
	 * @param mixed $str Native/primitive string value OR another GString object to initialize with
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
	 * @param mixed $str Native/primitive string value OR another GString object to use
	 *
	 * @return boolean true if the string is equl to us, else false
	 */
	public function equals($str) {
		return ($this->str ==  $this->mixedVal($str));
	}

	/**
	 * Get the contents of this strin as an array of fixed-length (chunkSize) chunks
	 *
	 * If chunkSize is 4 and the string length is 8, then you'll get two 4-character string
	 * elements in the result array. If chunksize is 4 and string length is 7, then you'll get
	 * one chunk of 4 chars and the second chunk with only 3 chars...
	 *
	 * @param integer $chunkSize Number of characters (>=1) for each chunk to have
	 *
	 * @return array An array of sub-strings each chunkSize in length, possible exception of last
	 */
	public function getChunked($chunkSize) {
		$chunks = array();
		$size = (integer) $chunkSize;
		if ($size <= 0) return $chunks;
		$tstr = $this->str;
		while (strlen($tstr) > 0) {
			$chunks[] = substr($tstr, 0, $size);
			$tstr = substr($tstr, $size);
		}

		return $chunks;
	}

	/**
	 * Get the value of either a native/primitive or OOP GString
	 *
	 * With enforcement!
	 *
	 * @param mixed $str Native/primitive string value OR another GString object to use
	 *
	 * @return string The value of the string either way
	 */
	protected function mixedVal($str) {
		return ($this->stringType($str) == 'string') ? $str : $str->get();
	}

	/**
	 * Is the argument a string (native/primitive) or GString (object)?
	 *
	 * @param mixed $str Native/primitive string value OR another GString object to use
	 *
	 * @return string Either 'string' or 'GString', depending
	 */
	protected function stringType(&$str) {
		switch (gettype($str)) {
			case 'string': return 'string';
			case 'object': if (is_a($str, __CLASS__)) return 'GString';
			default: throw new \Exception("Attempted to use a GString with something other than a string ('" . gettype($str) . "'");
		}
	}
}

