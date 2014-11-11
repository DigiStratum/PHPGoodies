<?php
/**
 * PHPGoodies:AxisAttribute - AXIS element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * AxisAttribute - AXIS element attribute trait for NodeElements to easily use
 */
trait AxisAttribute {
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

