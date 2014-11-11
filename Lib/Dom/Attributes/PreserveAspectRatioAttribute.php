<?php
/**
 * PHPGoodies:PreserveAspectRatioAttribute - PRESERVEASPECTRATIO element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * PreserveAspectRatioAttribute - PRESERVEASPECTRATIO element attribute trait for NodeElements to easily use
 */
trait PreserveAspectRatioAttribute {
	/**
	 * Set the preserveaspectratio attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setPreserveAspectRatio($value) {
		$this->setAttribute('preserveaspectratio', $value);

		return $this;
	}

	/**
	 * Get the preserveaspectratio attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getPreserveAspectRatio() {
		return $this->getAttribute('preserveaspectratio');
	}
}

