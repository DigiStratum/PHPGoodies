<?php
/**
 * PHPGoodies:TypeMustMatchAttribute - TYPEMUSTMATCH element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * TypeMustMatchAttribute - TYPEMUSTMATCH element attribute trait for NodeElements to easily use
 */
trait TypeMustMatchAttribute {
	/**
	 * Set the typemustmatch attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setTypeMustMatch($value) {
		$this->setAttribute('typemustmatch', $value);

		return $this;
	}

	/**
	 * Get the typemustmatch attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getTypeMustMatch() {
		return $this->getAttribute('typemustmatch');
	}
}

