<?php
/**
 * PHPGoodies:PlayedAttribute - PLAYED element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * PlayedAttribute - PLAYED element attribute trait for NodeElements to easily use
 */
trait PlayedAttribute {
	/**
	 * Set the played attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setPlayed($value) {
		$this->setAttribute('played', $value);

		return $this;
	}

	/**
	 * Get the played attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getPlayed() {
		return $this->getAttribute('played');
	}
}

