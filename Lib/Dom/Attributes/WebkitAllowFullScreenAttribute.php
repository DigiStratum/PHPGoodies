<?php
/**
 * PHPGoodies:WebkitAllowFullScreenAttribute - WEBKITALLOWFULLSCREEN element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * WebkitAllowFullScreenAttribute - WEBKITALLOWFULLSCREEN element attribute trait for NodeElements to easily use
 */
trait WebkitAllowFullScreenAttribute {
	/**
	 * Set the webkitallowfullscreen attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setWebkitAllowFullScreen($value) {
		$this->setAttribute('webkitallowfullscreen', $value);

		return $this;
	}

	/**
	 * Get the webkitallowfullscreen attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getWebkitAllowFullScreen() {
		return $this->getAttribute('webkitallowfullscreen');
	}
}
