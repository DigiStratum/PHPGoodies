<?php
/**
 * PHPGoodies:OnBlurAttribute - ONBLUR element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * OnBlurAttribute - ONBLUR element attribute trait for NodeElements to easily use
 */
trait OnBlurAttribute {
	/**
	 * Set the onblur attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setOnBlur($value) {
		$this->setAttribute('onblur', $value);

		return $this;
	}

	/**
	 * Get the onblur attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getOnBlur() {
		return $this->getAttribute('onblur');
	}
}

