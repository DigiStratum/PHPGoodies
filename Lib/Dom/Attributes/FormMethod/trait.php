<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_FormMethod - FORMMETHOD element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * FormMethod - FORMMETHOD element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_FormMethod {
	/**
	 * Set the formmethod attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setFormMethod($value) {
		$this->setAttribute('formmethod', $value);

		return $this;
	}

	/**
	 * Get the formmethod attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getFormMethod() {
		return $this->getAttribute('formmethod');
	}
}

