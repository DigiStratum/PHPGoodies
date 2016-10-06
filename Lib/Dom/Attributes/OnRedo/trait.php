<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_OnRedo - ONREDO element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * OnRedo - ONREDO element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_OnRedo {
	/**
	 * Set the onredo attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setOnRedo($value) {
		$this->setAttribute('onredo', $value);

		return $this;
	}

	/**
	 * Get the onredo attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getOnRedo() {
		return $this->getAttribute('onredo');
	}
}

