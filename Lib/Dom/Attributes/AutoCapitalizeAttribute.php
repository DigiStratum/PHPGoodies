<?php
/**
 * PHPGoodies:AutoCapitalizeAttribute - AUTOCAPITALIZE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * AutoCapitalizeAttribute - AUTOCAPITALIZE element attribute trait for NodeElements to easily use
 */
trait AutoCapitalizeAttribute {
	/**
	 * Set the autocapitalize attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setAutoCapitalize($value) {
		$this->setAttribute('autocapitalize', $value);

		return $this;
	}

	/**
	 * Get the autocapitalize attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getAutoCapitalize() {
		return $this->getAttribute('autocapitalize');
	}
}

