<?php
/**
 * PHPGoodies:FormNoValidateAttribute - FORMNOVALIDATE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * FormNoValidateAttribute - FORMNOVALIDATE element attribute trait for NodeElements to easily use
 */
trait FormNoValidateAttribute {
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

