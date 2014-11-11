<?php
/**
 * PHPGoodies:ControlsAttribute - CONTROLS element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * ControlsAttribute - CONTROLS element attribute trait for NodeElements to easily use
 */
trait ControlsAttribute {
	/**
	 * Set the controls attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setControls($value) {
		$this->setAttribute('controls', $value);

		return $this;
	}

	/**
	 * Get the controls attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getControls() {
		return $this->getAttribute('controls');
	}
}

