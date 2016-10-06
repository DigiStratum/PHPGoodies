<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Wrap - WRAP element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Wrap - WRAP element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Wrap {
	/**
	 * Set the wrap attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setWrap($value) {
		$this->setAttribute('wrap', $value);

		return $this;
	}

	/**
	 * Get the wrap attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getWrap() {
		return $this->getAttribute('wrap');
	}
}

