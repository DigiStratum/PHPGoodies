<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_OnBlur - ONBLUR element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * OnBlur - ONBLUR element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_OnBlur {
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

