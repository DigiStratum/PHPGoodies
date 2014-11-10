<?php
/**
 * PHPGoodies:BottomMarginAttribute - BOTTOMMARGIN element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * BottomMarginAttribute - BOTTOMMARGIN element attribute trait for NodeElements to easily use
 */
trait BottomMarginAttribute {
	/**
	 * Set the bottommargin attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setBottomMargin($value) {
		$this->setAttribute('bottommargin', $value);

		return $this;
	}

	/**
	 * Get the bottommargin attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getBottomMargin() {
		return $this->getAttribute('bottommargin');
	}
}

