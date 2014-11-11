<?php
/**
 * PHPGoodies:NoWrapAttribute - NOWRAP element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * NoWrapAttribute - NOWRAP element attribute trait for NodeElements to easily use
 */
trait NoWrapAttribute {
	/**
	 * Set the nowrap attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setNoWrap($value) {
		$this->setAttribute('nowrap', $value);

		return $this;
	}

	/**
	 * Get the nowrap attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getNoWrap() {
		return $this->getAttribute('nowrap');
	}
}

