<?php
/**
 * PHPGoodies:BGColorAttribute - BGCOLOR element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * BGColorAttribute - BGCOLOR element attribute trait for NodeElements to easily use
 */
trait BGColorAttribute {
	/**
	 * Set the bgcolor attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setBGColor($value) {
		$this->setAttribute('bgcolor', $value);

		return $this;
	}

	/**
	 * Get the bgcolor attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getBGColor() {
		return $this->getAttribute('bgcolor');
	}
}
