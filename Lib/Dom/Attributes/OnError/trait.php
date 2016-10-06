<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_OnError - ONERROR element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * OnError - ONERROR element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_OnError {
	/**
	 * Set the onerror attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setOnError($value) {
		$this->setAttribute('onerror', $value);

		return $this;
	}

	/**
	 * Get the onerror attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getOnError() {
		return $this->getAttribute('onerror');
	}
}

