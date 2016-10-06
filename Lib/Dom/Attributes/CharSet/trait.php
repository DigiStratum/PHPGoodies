<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_CharSet - CHARSET element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * CharSet - CHARSET element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_CharSet {
	/**
	 * Set the charset attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setCharSet($value) {
		$this->setAttribute('charset', $value);

		return $this;
	}

	/**
	 * Get the charset attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getCharSet() {
		return $this->getAttribute('charset');
	}
}

