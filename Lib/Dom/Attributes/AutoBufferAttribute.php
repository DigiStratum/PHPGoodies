<?php
/**
 * PHPGoodies:AutoBufferAttribute - AUTOBUFFER element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * AutoBufferAttribute - AUTOBUFFER element attribute trait for NodeElements to easily use
 */
trait AutoBufferAttribute {
	/**
	 * Set the autobuffer attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setAutoBuffer($value) {
		$this->setAttribute('autobuffer', $value);

		return $this;
	}

	/**
	 * Get the autobuffer attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getAutoBuffer() {
		return $this->getAttribute('autobuffer');
	}
}

