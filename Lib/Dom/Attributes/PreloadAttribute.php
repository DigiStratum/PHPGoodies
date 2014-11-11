<?php
/**
 * PHPGoodies:PreloadAttribute - PRELOAD element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * PreloadAttribute - PRELOAD element attribute trait for NodeElements to easily use
 */
trait PreloadAttribute {
	/**
	 * Set the preload attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setPreload($value) {
		$this->setAttribute('preload', $value);

		return $this;
	}

	/**
	 * Get the preload attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getPreload() {
		return $this->getAttribute('preload');
	}
}
