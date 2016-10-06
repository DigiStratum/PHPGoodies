<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_FrameBorder - FRAMEBORDER element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * FrameBorder - FRAMEBORDER element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_FrameBorder {
	/**
	 * Set the frameborder attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setFrameBorder($value) {
		$this->setAttribute('frameborder', $value);

		return $this;
	}

	/**
	 * Get the frameborder attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getFrameBorder() {
		return $this->getAttribute('frameborder');
	}
}

