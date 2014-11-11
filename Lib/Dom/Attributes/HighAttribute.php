<?php
/**
 * PHPGoodies:HighAttribute - HIGH element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * HighAttribute - HIGH element attribute trait for NodeElements to easily use
 */
trait HighAttribute {
	/**
	 * Set the high attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setHigh($value) {
		$this->setAttribute('high', $value);

		return $this;
	}

	/**
	 * Get the high attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getHigh() {
		return $this->getAttribute('high');
	}
}

