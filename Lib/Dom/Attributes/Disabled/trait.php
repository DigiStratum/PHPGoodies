<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Disabled - DISABLED element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Disabled - DISABLED element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Disabled {
	/**
	 * Set the disabled attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setDisabled($value) {
		$this->setAttribute('disabled', $value);

		return $this;
	}

	/**
	 * Get the disabled attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getDisabled() {
		return $this->getAttribute('disabled');
	}
}

