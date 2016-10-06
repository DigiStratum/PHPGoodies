<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_RowSpan - ROWSPAN element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * RowSpan - ROWSPAN element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_RowSpan {
	/**
	 * Set the rowspan attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setRowSpan($value) {
		$this->setAttribute('rowspan', $value);

		return $this;
	}

	/**
	 * Get the rowspan attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getRowSpan() {
		return $this->getAttribute('rowspan');
	}
}

