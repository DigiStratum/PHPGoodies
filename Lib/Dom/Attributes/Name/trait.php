<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Name - NAME element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Name - NAME element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Name {
	/**
	 * Set the name attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setName($value) {
		$this->setAttribute('name', $value);

		return $this;
	}

	/**
	 * Get the name attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getName() {
		return $this->getAttribute('name');
	}
}

