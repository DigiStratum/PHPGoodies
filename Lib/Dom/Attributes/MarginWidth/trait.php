<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_MarginWidth - MARGINWIDTH element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * MarginWidth - MARGINWIDTH element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_MarginWidth {
	/**
	 * Set the marginwidth attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setMarginWidth($value) {
		$this->setAttribute('marginwidth', $value);

		return $this;
	}

	/**
	 * Get the marginwidth attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getMarginWidth() {
		return $this->getAttribute('marginwidth');
	}
}

