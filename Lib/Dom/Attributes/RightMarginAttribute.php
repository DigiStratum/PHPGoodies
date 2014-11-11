<?php
/**
 * PHPGoodies:RightMarginAttribute - RIGHTMARGIN element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * RightMarginAttribute - RIGHTMARGIN element attribute trait for NodeElements to easily use
 */
trait RightMarginAttribute {
	/**
	 * Set the rightmargin attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setRightMargin($value) {
		$this->setAttribute('rightmargin', $value);

		return $this;
	}

	/**
	 * Get the rightmargin attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getRightMargin() {
		return $this->getAttribute('rightmargin');
	}
}

