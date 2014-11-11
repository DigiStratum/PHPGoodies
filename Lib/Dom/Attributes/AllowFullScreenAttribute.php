<?php
/**
 * PHPGoodies:AllowFullScreenAttribute - ALLOWFULLSCREEN element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * AllowFullScreenAttribute - ALLOWFULLSCREEN element attribute trait for NodeElements to easily use
 */
trait AllowFullScreenAttribute {
	/**
	 * Set the allowfullscreen attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setAllowFullScreen($value) {
		$this->setAttribute('allowfullscreen', $value);

		return $this;
	}

	/**
	 * Get the allowfullscreen attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getAllowFullScreen() {
		return $this->getAttribute('allowfullscreen');
	}
}

