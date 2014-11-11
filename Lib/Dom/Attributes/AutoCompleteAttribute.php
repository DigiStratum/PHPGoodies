<?php
/**
 * PHPGoodies:AutoCompleteAttribute - AUTOCOMPLETE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * AutoCompleteAttribute - AUTOCOMPLETE element attribute trait for NodeElements to easily use
 */
trait AutoCompleteAttribute {
	/**
	 * Set the autocomplete attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setAutoComplete($value) {
		$this->setAttribute('autocomplete', $value);

		return $this;
	}

	/**
	 * Get the autocomplete attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getAutoComplete() {
		return $this->getAttribute('autocomplete');
	}
}

