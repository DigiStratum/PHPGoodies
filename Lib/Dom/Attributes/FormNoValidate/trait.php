<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_FormNoValidate - FORMNOVALIDATE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * FormNoValidate - FORMNOVALIDATE element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_FormNoValidate {
	/**
	 * Set the formnovalidate attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setFormNoValidate($value) {
		$this->setAttribute('formnovalidate', $value);

		return $this;
	}

	/**
	 * Get the formnovalidate attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getFormNoValidate() {
		return $this->getAttribute('formnovalidate');
	}
}

