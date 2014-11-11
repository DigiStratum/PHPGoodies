<?php
/**
 * PHPGoodies:DefaultAttribute - DEFAULT element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * DefaultAttribute - DEFAULT element attribute trait for NodeElements to easily use
 */
trait DefaultAttribute {
	/**
	 * Set the default attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setDefault($value) {
		$this->setAttribute('default', $value);

		return $this;
	}

	/**
	 * Get the default attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getDefault() {
		return $this->getAttribute('default');
	}
}

