<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Accept - ACCEPT element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Accept - ACCEPT element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Accept {
	/**
	 * Set the accept attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setAccept($value) {
		$this->setAttribute('accept', $value);

		return $this;
	}

	/**
	 * Get the accept attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getAccept() {
		return $this->getAttribute('accept');
	}
}

