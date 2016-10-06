<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_InputMode - INPUTMODE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * InputMode - INPUTMODE element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_InputMode {
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

