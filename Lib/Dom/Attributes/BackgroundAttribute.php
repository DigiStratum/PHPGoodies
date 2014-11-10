<?php
/**
 * PHPGoodies:BackgroundAttribute - BACKGROUND element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * BackgroundAttribute - BACKGROUND element attribute trait for NodeElements to easily use
 */
trait BackgroundAttribute {
	/**
	 * Set the background attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setBackground($value) {
		$this->setAttribute('background', $value);

		return $this;
	}

	/**
	 * Get the background attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getBackground() {
		return $this->getAttribute('background');
	}
}
