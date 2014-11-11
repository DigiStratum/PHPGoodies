<?php
/**
 * PHPGoodies:FormActionAttribute - FORMACTION element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * FormActionAttribute - FORMACTION element attribute trait for NodeElements to easily use
 */
trait FormActionAttribute {
	/**
	 * Set the formaction attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setFormAction($value) {
		$this->setAttribute('formaction', $value);

		return $this;
	}

	/**
	 * Get the formaction attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getFormAction() {
		return $this->getAttribute('formaction');
	}
}

