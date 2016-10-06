<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Data - DATA element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Data - DATA element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Data {
	/**
	 * Set the data attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setData($value) {
		$this->setAttribute('data', $value);

		return $this;
	}

	/**
	 * Get the data attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getData() {
		return $this->getAttribute('data');
	}
}

