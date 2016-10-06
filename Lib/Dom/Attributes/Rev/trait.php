<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Rev - REV element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Rev - REV element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Rev {
	/**
	 * Set the rev attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setRev($value) {
		$this->setAttribute('rev', $value);

		return $this;
	}

	/**
	 * Get the rev attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getRev() {
		return $this->getAttribute('rev');
	}
}

