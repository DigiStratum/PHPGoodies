<?php
/**
 * PHPGoodies:RowsAttribute - ROWS element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * RowsAttribute - ROWS element attribute trait for NodeElements to easily use
 */
trait RowsAttribute {
	/**
	 * Set the rows attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setRows($value) {
		$this->setAttribute('rows', $value);

		return $this;
	}

	/**
	 * Get the rows attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getRows() {
		return $this->getAttribute('rows');
	}
}

