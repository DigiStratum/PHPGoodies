<?php
/**
 * PHPGoodies:LowAttribute - LOW element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * LowAttribute - LOW element attribute trait for NodeElements to easily use
 */
trait LowAttribute {
	/**
	 * Set the low attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setLow($value) {
		$this->setAttribute('low', $value);

		return $this;
	}

	/**
	 * Get the low attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getLow() {
		return $this->getAttribute('low');
	}
}

