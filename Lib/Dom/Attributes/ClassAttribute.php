<?php
/**
 * PHPGoodies:ClassAttribute - CLASS element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * ClassAttribute - CLASS element attribute trait for NodeElements to easily use
 */
trait ClassAttribute {
	/**
	 * Set the class attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setClass($value) {
		$this->setAttribute('class', $value);

		return $this;
	}

	/**
	 * Get the class attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getClass() {
		return $this->getAttribute('class');
	}
}

