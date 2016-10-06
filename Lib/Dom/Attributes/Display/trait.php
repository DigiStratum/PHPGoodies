<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Display - DISPLAY element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Display - DISPLAY element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Display {
	/**
	 * Set the display attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setDisplay($value) {
		$this->setAttribute('display', $value);

		return $this;
	}

	/**
	 * Get the display attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getDisplay() {
		return $this->getAttribute('display');
	}
}

