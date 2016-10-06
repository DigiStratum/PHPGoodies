<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Max - MAX element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Max - MAX element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Max {
	/**
	 * Set the max attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setMax($value) {
		$this->setAttribute('max', $value);

		return $this;
	}

	/**
	 * Get the max attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getMax() {
		return $this->getAttribute('max');
	}
}

