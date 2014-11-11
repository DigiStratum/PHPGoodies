<?php
/**
 * PHPGoodies:ShapeAttribute - SHAPE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * ShapeAttribute - SHAPE element attribute trait for NodeElements to easily use
 */
trait ShapeAttribute {
	/**
	 * Set the shape attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setShape($value) {
		$this->setAttribute('shape', $value);

		return $this;
	}

	/**
	 * Get the shape attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getShape() {
		return $this->getAttribute('shape');
	}
}

