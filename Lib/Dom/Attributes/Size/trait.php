<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Size - SIZE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Size - SIZE element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Size {
	/**
	 * Set the size attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setSize($value) {
		$this->setAttribute('size', $value);

		return $this;
	}

	/**
	 * Get the size attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getSize() {
		return $this->getAttribute('size');
	}
}

