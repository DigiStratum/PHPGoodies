<?php
/**
 * PHPGoodies:CheckedAttribute - CHECKED element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * CheckedAttribute - CHECKED element attribute trait for NodeElements to easily use
 */
trait CheckedAttribute {
	/**
	 * Set the checked attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setChecked($value) {
		$this->setAttribute('checked', $value);

		return $this;
	}

	/**
	 * Get the checked attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getChecked() {
		return $this->getAttribute('checked');
	}
}

