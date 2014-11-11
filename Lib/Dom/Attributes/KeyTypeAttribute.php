<?php
/**
 * PHPGoodies:KeyTypeAttribute - KEYTYPE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * KeyTypeAttribute - KEYTYPE element attribute trait for NodeElements to easily use
 */
trait KeyTypeAttribute {
	/**
	 * Set the keytype attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setKeyType($value) {
		$this->setAttribute('keytype', $value);

		return $this;
	}

	/**
	 * Get the keytype attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getKeyType() {
		return $this->getAttribute('keytype');
	}
}

