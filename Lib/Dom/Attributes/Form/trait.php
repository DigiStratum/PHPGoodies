<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Form - FORM element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Form - FORM element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Form {
	/**
	 * Set the form attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setForm($value) {
		$this->setAttribute('form', $value);

		return $this;
	}

	/**
	 * Get the form attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getForm() {
		return $this->getAttribute('form');
	}
}

