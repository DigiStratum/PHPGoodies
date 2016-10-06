<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_IsMap - ISMAP element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * IsMap - ISMAP element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_IsMap {
	/**
	 * Set the ismap attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setIsMap($value) {
		$this->setAttribute('ismap', $value);

		return $this;
	}

	/**
	 * Get the ismap attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getIsMap() {
		return $this->getAttribute('ismap');
	}
}

