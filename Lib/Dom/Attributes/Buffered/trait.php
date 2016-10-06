<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Buffered - BUFFERED element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Buffered - BUFFERED element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Buffered {
	/**
	 * Set the buffered attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setBuffered($value) {
		$this->setAttribute('buffered', $value);

		return $this;
	}

	/**
	 * Get the buffered attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getBuffered() {
		return $this->getAttribute('buffered');
	}
}

