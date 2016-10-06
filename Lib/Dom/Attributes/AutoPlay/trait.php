<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_AutoPlay - AUTOPLAY element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * AutoPlay - AUTOPLAY element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_AutoPlay {
	/**
	 * Set the autoplay attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setAutoPlay($value) {
		$this->setAttribute('autoplay', $value);

		return $this;
	}

	/**
	 * Get the autoplay attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getAutoPlay() {
		return $this->getAttribute('autoplay');
	}
}

