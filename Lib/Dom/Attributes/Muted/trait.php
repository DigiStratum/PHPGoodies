<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Muted - MUTED element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Muted - MUTED element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Muted {
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

