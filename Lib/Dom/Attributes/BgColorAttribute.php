<?php
/**
 * PHPGoodies:BgColorAttribute - BGCOLOR element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * BgColorAttribute - BGCOLOR element attribute trait for NodeElements to easily use
 */
trait BgColorAttribute {
	/**
	 * Set the bgcolor attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setBgColor($value) {
		$this->setAttribute('bgcolor', $value);

		return $this;
	}

	/**
	 * Get the bgcolor attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getBgColor() {
		return $this->getAttribute('bgcolor');
	}
}

