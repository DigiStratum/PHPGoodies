<?php
/**
 * PHPGoodies:VolumeAttribute - VOLUME element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * VolumeAttribute - VOLUME element attribute trait for NodeElements to easily use
 */
trait VolumeAttribute {
	/**
	 * Set the volume attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setVolume($value) {
		$this->setAttribute('volume', $value);

		return $this;
	}

	/**
	 * Get the volume attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getVolume() {
		return $this->getAttribute('volume');
	}
}

