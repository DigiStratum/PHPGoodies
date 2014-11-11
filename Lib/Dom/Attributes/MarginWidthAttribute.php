<?php
/**
 * PHPGoodies:MarginWidthAttribute - MARGINWIDTH element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * MarginWidthAttribute - MARGINWIDTH element attribute trait for NodeElements to easily use
 */
trait MarginWidthAttribute {
	/**
	 * Set the marginwidth attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setMarginWidth($value) {
		$this->setAttribute('marginwidth', $value);

		return $this;
	}

	/**
	 * Get the marginwidth attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getMarginWidth() {
		return $this->getAttribute('marginwidth');
	}
}

