<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Axis - AXIS element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Axis - AXIS element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Axis {
	/**
	 * Set the axis attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setAxis($value) {
		$this->setAttribute('axis', $value);

		return $this;
	}

	/**
	 * Get the axis attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getAxis() {
		return $this->getAttribute('axis');
	}
}

