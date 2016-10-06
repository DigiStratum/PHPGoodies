<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Class - CLASS element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Class - CLASS element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Class {
	/**
	 * Set the class attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setClass($value) {
		$this->setAttribute('class', $value);

		return $this;
	}

	/**
	 * Get the class attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getClass() {
		return $this->getAttribute('class');
	}
}

