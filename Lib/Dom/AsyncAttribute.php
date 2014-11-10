<?php
/**
 * PHPGoodies:AsyncAttribute - ASYNC element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * AsyncAttribute - ASYNC element attribute trait for NodeElements to easily use
 */
trait AsyncAttribute {
	/**
	 * Set the async attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setAsync($value) {
		$this->setAttribute('async', $value);

		return $this;
	}

	/**
	 * Get the async attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getAsync() {
		return $this->getAttribute('async');
	}
}

