<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_X - X element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * X - X element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_X {
	/**
	 * Set the x attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setX($value) {
		$this->setAttribute('x', $value);

		return $this;
	}

	/**
	 * Get the x attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getX() {
		return $this->getAttribute('x');
	}
}

