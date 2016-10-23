<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_CharOff - CHAROFF element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * CharOff - CHAROFF element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_CharOff {
	/**
	 * Set the charoff attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setCharOff($value) {
		$this->setAttribute('charoff', $value);

		return $this;
	}

	/**
	 * Get the charoff attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getCharOff() {
		return $this->getAttribute('charoff');
	}
}
