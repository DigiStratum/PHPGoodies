<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Sizes - SIZES element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Sizes - SIZES element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Sizes {
	/**
	 * Set the sizes attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setSizes($value) {
		$this->setAttribute('sizes', $value);

		return $this;
	}

	/**
	 * Get the sizes attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getSizes() {
		return $this->getAttribute('sizes');
	}
}

