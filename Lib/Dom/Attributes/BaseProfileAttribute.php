<?php
/**
 * PHPGoodies:BaseProfileAttribute - BASEPROFILE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * BaseProfileAttribute - BASEPROFILE element attribute trait for NodeElements to easily use
 */
trait BaseProfileAttribute {
	/**
	 * Set the baseprofile attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setBaseProfile($value) {
		$this->setAttribute('baseprofile', $value);

		return $this;
	}

	/**
	 * Get the baseprofile attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getBaseProfile() {
		return $this->getAttribute('baseprofile');
	}
}

