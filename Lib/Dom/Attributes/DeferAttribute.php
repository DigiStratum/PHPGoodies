<?php
/**
 * PHPGoodies:DeferAttribute - DEFER element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * DeferAttribute - DEFER element attribute trait for NodeElements to easily use
 */
trait DeferAttribute {
	/**
	 * Set the defer attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setDefer($value) {
		$this->setAttribute('defer', $value);

		return $this;
	}

	/**
	 * Get the defer attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getDefer() {
		return $this->getAttribute('defer');
	}
}

