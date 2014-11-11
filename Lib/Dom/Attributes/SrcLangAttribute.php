<?php
/**
 * PHPGoodies:SrcLangAttribute - SRCLANG element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * SrcLangAttribute - SRCLANG element attribute trait for NodeElements to easily use
 */
trait SrcLangAttribute {
	/**
	 * Set the srclang attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setSrcLang($value) {
		$this->setAttribute('srclang', $value);

		return $this;
	}

	/**
	 * Get the srclang attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getSrcLang() {
		return $this->getAttribute('srclang');
	}
}

