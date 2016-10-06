<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_SrcLang - SRCLANG element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * SrcLang - SRCLANG element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_SrcLang {
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

