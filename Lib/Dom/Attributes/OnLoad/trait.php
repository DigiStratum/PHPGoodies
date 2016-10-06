<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_OnLoad - ONLOAD element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * OnLoad - ONLOAD element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_OnLoad {
	/**
	 * Set the onload attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setOnLoad($value) {
		$this->setAttribute('onload', $value);

		return $this;
	}

	/**
	 * Get the onload attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getOnLoad() {
		return $this->getAttribute('onload');
	}
}

