<?php
/**
 * PHPGoodies:NoValidateAttribute - NOVALIDATE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * NoValidateAttribute - NOVALIDATE element attribute trait for NodeElements to easily use
 */
trait NoValidateAttribute {
	/**
	 * Set the novalidate attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setNoValidate($value) {
		$this->setAttribute('novalidate', $value);

		return $this;
	}

	/**
	 * Get the novalidate attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getNoValidate() {
		return $this->getAttribute('novalidate');
	}
}

