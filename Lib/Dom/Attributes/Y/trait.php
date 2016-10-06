<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Y - Y element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Y - Y element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Y {
	/**
	 * Set the y attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setY($value) {
		$this->setAttribute('y', $value);

		return $this;
	}

	/**
	 * Get the y attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getY() {
		return $this->getAttribute('y');
	}
}

