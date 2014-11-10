<?php
/**
 * PHPGoodies:DateTimeAttribute - DATETIME element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * DateTimeAttribute - DATETIME element attribute trait for NodeElements to easily use
 */
trait DateTimeAttribute {
	/**
	 * Set the datetime attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setDateTime($value) {
		$this->setAttribute('datetime', $value);

		return $this;
	}

	/**
	 * Get the datetime attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getDateTime() {
		return $this->getAttribute('datetime');
	}
}

