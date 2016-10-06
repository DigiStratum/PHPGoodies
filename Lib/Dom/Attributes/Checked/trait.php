<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Checked - CHECKED element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Checked - CHECKED element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Checked {
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

