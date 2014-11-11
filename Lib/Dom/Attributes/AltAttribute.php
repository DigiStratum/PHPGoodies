<?php
/**
 * PHPGoodies:AltAttribute - ALT element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * AltAttribute - ALT element attribute trait for NodeElements to easily use
 */
trait AltAttribute {
	/**
	 * Set the alt attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setAlt($value) {
		$this->setAttribute('alt', $value);

		return $this;
	}

	/**
	 * Get the alt attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getAlt() {
		return $this->getAttribute('alt');
	}
}

