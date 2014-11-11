<?php
/**
 * PHPGoodies:CellPaddingAttribute - CELLPADDING element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * CellPaddingAttribute - CELLPADDING element attribute trait for NodeElements to easily use
 */
trait CellPaddingAttribute {
	/**
	 * Set the cellpadding attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setCellPadding($value) {
		$this->setAttribute('cellpadding', $value);

		return $this;
	}

	/**
	 * Get the cellpadding attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getCellPadding() {
		return $this->getAttribute('cellpadding');
	}
}

