<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_OnLanguageChange - ONLANGUAGECHANGE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * OnLanguageChange - ONLANGUAGECHANGE element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_OnLanguageChange {
	/**
	 * Set the onlanguagechange attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setOnLanguageChange($value) {
		$this->setAttribute('onlanguagechange', $value);

		return $this;
	}

	/**
	 * Get the onlanguagechange attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getOnLanguageChange() {
		return $this->getAttribute('onlanguagechange');
	}
}

