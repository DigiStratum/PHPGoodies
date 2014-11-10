<?php
/**
 * PHPGoodies:LangAttribute - LANG element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * LangAttribute - LANG element attribute trait for NodeElements to easily use
 */
trait LangAttribute {
	/**
	 * Set the lang attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setLang($value) {
		$this->setAttribute('lang', $value);

		return $this;
	}

	/**
	 * Get the lang attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getLang() {
		return $this->getAttribute('lang');
	}
}

