<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_MinLength - MINLENGTH element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * MinLength - MINLENGTH element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_MinLength {
	/**
	 * Set the minlength attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setMinLength($value) {
		$this->setAttribute('minlength', $value);

		return $this;
	}

	/**
	 * Get the minlength attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getMinLength() {
		return $this->getAttribute('minlength');
	}
}

