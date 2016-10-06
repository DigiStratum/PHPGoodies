<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Multiple - MULTIPLE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Multiple - MULTIPLE element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Multiple {
	/**
	 * Set the multiple attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setMultiple($value) {
		$this->setAttribute('multiple', $value);

		return $this;
	}

	/**
	 * Get the multiple attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getMultiple() {
		return $this->getAttribute('multiple');
	}
}

