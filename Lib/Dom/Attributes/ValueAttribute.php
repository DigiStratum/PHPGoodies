<?php
/**
 * PHPGoodies:ValueAttribute - VALUE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * ValueAttribute - VALUE element attribute trait for NodeElements to easily use
 */
trait ValueAttribute {
	/**
	 * Set the value attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setValue($value) {
		$this->setAttribute('value', $value);

		return $this;
	}

	/**
	 * Get the value attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getValue() {
		return $this->getAttribute('value');
	}
}

