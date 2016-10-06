<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_FormEncType - FORMENCTYPE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * FormEncType - FORMENCTYPE element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_FormEncType {
	/**
	 * Set the formenctype attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setFormEncType($value) {
		$this->setAttribute('formenctype', $value);

		return $this;
	}

	/**
	 * Get the formenctype attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getFormEncType() {
		return $this->getAttribute('formenctype');
	}
}

