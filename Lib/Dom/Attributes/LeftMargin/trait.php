<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_LeftMargin - LEFTMARGIN element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * LeftMargin - LEFTMARGIN element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_LeftMargin {
	/**
	 * Set the leftmargin attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setLeftMargin($value) {
		$this->setAttribute('leftmargin', $value);

		return $this;
	}

	/**
	 * Get the leftmargin attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getLeftMargin() {
		return $this->getAttribute('leftmargin');
	}
}

