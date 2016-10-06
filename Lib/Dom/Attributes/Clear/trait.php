<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Clear - CLEAR element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Clear - CLEAR element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Clear {
	/**
	 * Set the clear attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setClear($value) {
		$this->setAttribute('clear', $value);

		return $this;
	}

	/**
	 * Get the clear attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getClear() {
		return $this->getAttribute('clear');
	}
}

