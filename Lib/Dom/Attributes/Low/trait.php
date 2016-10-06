<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Low - LOW element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Low - LOW element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Low {
	/**
	 * Set the low attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setLow($value) {
		$this->setAttribute('low', $value);

		return $this;
	}

	/**
	 * Get the low attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getLow() {
		return $this->getAttribute('low');
	}
}

