<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Coords - COORDS element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Coords - COORDS element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Coords {
	/**
	 * Set the coords attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setCoords($value) {
		$this->setAttribute('coords', $value);

		return $this;
	}

	/**
	 * Get the coords attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getCoords() {
		return $this->getAttribute('coords');
	}
}

