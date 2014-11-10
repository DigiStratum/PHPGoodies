<?php
/**
 * PHPGoodies:WrapAttribute - WRAP element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * WrapAttribute - WRAP element attribute trait for NodeElements to easily use
 */
trait WrapAttribute {
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

