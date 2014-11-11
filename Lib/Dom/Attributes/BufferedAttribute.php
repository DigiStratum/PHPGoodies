<?php
/**
 * PHPGoodies:BufferedAttribute - BUFFERED element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * BufferedAttribute - BUFFERED element attribute trait for NodeElements to easily use
 */
trait BufferedAttribute {
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

