<?php
/**
 * PHPGoodies:SchemeAttribute - SCHEME element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * SchemeAttribute - SCHEME element attribute trait for NodeElements to easily use
 */
trait SchemeAttribute {
	/**
	 * Set the scheme attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setScheme($value) {
		$this->setAttribute('scheme', $value);

		return $this;
	}

	/**
	 * Get the scheme attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getScheme() {
		return $this->getAttribute('scheme');
	}
}

