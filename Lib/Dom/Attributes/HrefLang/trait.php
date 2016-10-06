<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_HrefLang - HREFLANG element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * HrefLang - HREFLANG element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_HrefLang {
	/**
	 * Set the hreflang attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setHrefLang($value) {
		$this->setAttribute('hreflang', $value);

		return $this;
	}

	/**
	 * Get the hreflang attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getHrefLang() {
		return $this->getAttribute('hreflang');
	}
}

