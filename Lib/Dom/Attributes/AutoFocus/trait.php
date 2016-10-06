<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_AutoFocus - AUTOFOCUS element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * AutoFocus - AUTOFOCUS element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_AutoFocus {
	/**
	 * Set the autofocus attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setAutoFocus($value) {
		$this->setAttribute('autofocus', $value);

		return $this;
	}

	/**
	 * Get the autofocus attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getAutoFocus() {
		return $this->getAttribute('autofocus');
	}
}

