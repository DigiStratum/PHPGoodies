<?php
/**
 * PHPGoodies:ModeAttribute - MODE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * ModeAttribute - MODE element attribute trait for NodeElements to easily use
 */
trait ModeAttribute {
	/**
	 * Set the mode attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setMode($value) {
		$this->setAttribute('mode', $value);

		return $this;
	}

	/**
	 * Get the mode attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getMode() {
		return $this->getAttribute('mode');
	}
}

