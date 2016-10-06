<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Noshape - NOSHAPE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Noshape - NOSHAPE element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Noshape {
	/**
	 * Set the noshape attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setNoshape($value) {
		$this->setAttribute('noshape', $value);

		return $this;
	}

	/**
	 * Get the noshape attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getNoshape() {
		return $this->getAttribute('noshape');
	}
}

