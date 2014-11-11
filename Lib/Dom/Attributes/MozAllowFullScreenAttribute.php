<?php
/**
 * PHPGoodies:MozAllowFullScreenAttribute - MOZALLOWFULLSCREEN element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * MozAllowFullScreenAttribute - MOZALLOWFULLSCREEN element attribute trait for NodeElements to easily use
 */
trait MozAllowFullScreenAttribute {
	/**
	 * Set the mozallowfullscreen attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setMozAllowFullScreen($value) {
		$this->setAttribute('mozallowfullscreen', $value);

		return $this;
	}

	/**
	 * Get the mozallowfullscreen attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getMozAllowFullScreen() {
		return $this->getAttribute('mozallowfullscreen');
	}
}

