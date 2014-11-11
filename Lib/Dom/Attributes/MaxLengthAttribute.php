<?php
/**
 * PHPGoodies:MaxLengthAttribute - MAXLENGTH element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * MaxLengthAttribute - MAXLENGTH element attribute trait for NodeElements to easily use
 */
trait MaxLengthAttribute {
	/**
	 * Set the maxlength attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setMaxLength($value) {
		$this->setAttribute('maxlength', $value);

		return $this;
	}

	/**
	 * Get the maxlength attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getMaxLength() {
		return $this->getAttribute('maxlength');
	}
}

