<?php
/**
 * PHPGoodies:OverflowAttribute - OVERFLOW element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * OverflowAttribute - OVERFLOW element attribute trait for NodeElements to easily use
 */
trait OverflowAttribute {
	/**
	 * Set the overflow attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setOverflow($value) {
		$this->setAttribute('overflow', $value);

		return $this;
	}

	/**
	 * Get the overflow attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getOverflow() {
		return $this->getAttribute('overflow');
	}
}

