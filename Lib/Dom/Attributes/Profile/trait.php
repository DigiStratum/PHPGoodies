<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Profile - PROFILE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Profile - PROFILE element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Profile {
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

