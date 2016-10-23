<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Cols - COLS element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Cols - COLS element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Cols {
	/**
	 * Set the cols attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setCols($value) {
		$this->setAttribute('cols', $value);

		return $this;
	}

	/**
	 * Get the cols attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getCols() {
		return $this->getAttribute('cols');
	}
}
