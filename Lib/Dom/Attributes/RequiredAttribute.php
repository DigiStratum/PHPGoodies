<?php
/**
 * PHPGoodies:RequiredAttribute - REQUIRED element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * RequiredAttribute - REQUIRED element attribute trait for NodeElements to easily use
 */
trait RequiredAttribute {
	/**
	 * Set the required attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setRequired($value) {
		$this->setAttribute('required', $value);

		return $this;
	}

	/**
	 * Get the required attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getRequired() {
		return $this->getAttribute('required');
	}
}

