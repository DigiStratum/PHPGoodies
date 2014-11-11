<?php
/**
 * PHPGoodies:MozAppAttribute - MOZAPP element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * MozAppAttribute - MOZAPP element attribute trait for NodeElements to easily use
 */
trait MozAppAttribute {
	/**
	 * Set the mozapp attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setMozApp($value) {
		$this->setAttribute('mozapp', $value);

		return $this;
	}

	/**
	 * Get the mozapp attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getMozApp() {
		return $this->getAttribute('mozapp');
	}
}

