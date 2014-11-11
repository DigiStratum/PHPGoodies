<?php
/**
 * PHPGoodies:MutedAttribute - MUTED element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * MutedAttribute - MUTED element attribute trait for NodeElements to easily use
 */
trait MutedAttribute {
	/**
	 * Set the muted attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setMuted($value) {
		$this->setAttribute('muted', $value);

		return $this;
	}

	/**
	 * Get the muted attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getMuted() {
		return $this->getAttribute('muted');
	}
}

