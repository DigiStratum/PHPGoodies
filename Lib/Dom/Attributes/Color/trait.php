<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Color - COLOR element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Color - COLOR element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Color {
	/**
	 * Set the color attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setColor($value) {
		$this->setAttribute('color', $value);

		return $this;
	}

	/**
	 * Get the color attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getColor() {
		return $this->getAttribute('color');
	}
}

