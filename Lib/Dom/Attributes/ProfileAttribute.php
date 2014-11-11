<?php
/**
 * PHPGoodies:ProfileAttribute - PROFILE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * ProfileAttribute - PROFILE element attribute trait for NodeElements to easily use
 */
trait ProfileAttribute {
	/**
	 * Set the profile attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setProfile($value) {
		$this->setAttribute('profile', $value);

		return $this;
	}

	/**
	 * Get the profile attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getProfile() {
		return $this->getAttribute('profile');
	}
}

