<?php
/**
 * PHPGoodies:InputModeAttribute - INPUTMODE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * InputModeAttribute - INPUTMODE element attribute trait for NodeElements to easily use
 */
trait InputModeAttribute {
	/**
	 * Set the inputmode attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setInputMode($value) {
		$this->setAttribute('inputmode', $value);

		return $this;
	}

	/**
	 * Get the inputmode attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getInputMode() {
		return $this->getAttribute('inputmode');
	}
}

