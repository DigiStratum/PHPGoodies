<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_TypeMustMatch - TYPEMUSTMATCH element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * TypeMustMatch - TYPEMUSTMATCH element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_TypeMustMatch {
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

