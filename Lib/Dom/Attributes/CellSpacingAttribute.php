<?php
/**
 * PHPGoodies:CellSpacingAttribute - CELLSPACING element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * CellSpacingAttribute - CELLSPACING element attribute trait for NodeElements to easily use
 */
trait CellSpacingAttribute {
	/**
	 * Set the cellspacing attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setCellSpacing($value) {
		$this->setAttribute('cellspacing', $value);

		return $this;
	}

	/**
	 * Get the cellspacing attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getCellSpacing() {
		return $this->getAttribute('cellspacing');
	}
}

