<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Border - BORDER element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Border - BORDER element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Border {
	/**
	 * Set the border attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setBorder($value) {
		$this->setAttribute('border', $value);

		return $this;
	}

	/**
	 * Get the border attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getBorder() {
		return $this->getAttribute('border');
	}
}

