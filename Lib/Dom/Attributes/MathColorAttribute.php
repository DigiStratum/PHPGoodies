<?php
/**
 * PHPGoodies:MathColorAttribute - MATHCOLOR element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * MathColorAttribute - MATHCOLOR element attribute trait for NodeElements to easily use
 */
trait MathColorAttribute {
	/**
	 * Set the mathcolor attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setMathColor($value) {
		$this->setAttribute('mathcolor', $value);

		return $this;
	}

	/**
	 * Get the mathcolor attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getMathColor() {
		return $this->getAttribute('mathcolor');
	}
}

