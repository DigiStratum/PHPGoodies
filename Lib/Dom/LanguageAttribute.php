<?php
/**
 * PHPGoodies:LanguageAttribute - LANGUAGE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * LanguageAttribute - LANGUAGE element attribute trait for NodeElements to easily use
 */
trait LanguageAttribute {
	/**
	 * Set the language attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setLanguage($value) {
		$this->setAttribute('language', $value);

		return $this;
	}

	/**
	 * Get the language attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getLanguage() {
		return $this->getAttribute('language');
	}
}

