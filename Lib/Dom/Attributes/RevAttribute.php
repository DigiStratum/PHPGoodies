<?php
/**
 * PHPGoodies:RevAttribute - REV element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * RevAttribute - REV element attribute trait for NodeElements to easily use
 */
trait RevAttribute {
	/**
	 * Set the rev attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setRev($value) {
		$this->setAttribute('rev', $value);

		return $this;
	}

	/**
	 * Get the rev attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getRev() {
		return $this->getAttribute('rev');
	}
}

