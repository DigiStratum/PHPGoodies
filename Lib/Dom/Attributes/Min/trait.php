<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Min - MIN element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Min - MIN element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Min {
	/**
	 * Set the min attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setMin($value) {
		$this->setAttribute('min', $value);

		return $this;
	}

	/**
	 * Get the min attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getMin() {
		return $this->getAttribute('min');
	}
}

