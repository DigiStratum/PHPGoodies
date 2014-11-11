<?php
/**
 * PHPGoodies:EncTypeAttribute - ENCTYPE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * EncTypeAttribute - ENCTYPE element attribute trait for NodeElements to easily use
 */
trait EncTypeAttribute {
	/**
	 * Set the enctype attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setEncType($value) {
		$this->setAttribute('enctype', $value);

		return $this;
	}

	/**
	 * Get the enctype attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getEncType() {
		return $this->getAttribute('enctype');
	}
}

