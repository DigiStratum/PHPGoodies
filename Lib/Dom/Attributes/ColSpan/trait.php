<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_ColSpan - COLSPAN element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * ColSpan - COLSPAN element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_ColSpan {
	/**
	 * Set the colspan attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setColSpan($value) {
		$this->setAttribute('colspan', $value);

		return $this;
	}

	/**
	 * Get the colspan attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getColSpan() {
		return $this->getAttribute('colspan');
	}
}

