<?php
/**
 * PHPGoodies:TypeAttribute - TYPE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * TypeAttribute - TYPE element attribute trait for NodeElements to easily use
 */
trait TypeAttribute {
	/**
	 * Set the type attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setType($value) {
		$this->setAttribute('type', $value);

		return $this;
	}

	/**
	 * Get the type attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getType() {
		return $this->getAttribute('type');
	}
}

