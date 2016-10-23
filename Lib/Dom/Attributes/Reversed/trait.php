<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Reversed - REVERSED element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Reversed - REVERSED element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Reversed {
	/**
	 * Set the reversed attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setReversed($value) {
		$this->setAttribute('reversed', $value);

		return $this;
	}

	/**
	 * Get the reversed attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getReversed() {
		return $this->getAttribute('reversed');
	}
}
