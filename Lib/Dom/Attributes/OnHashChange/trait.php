<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_OnHashChange - ONHASHCHANGE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * OnHashChange - ONHASHCHANGE element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_OnHashChange {
	/**
	 * Set the onhashchange attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setOnHashChange($value) {
		$this->setAttribute('onhashchange', $value);

		return $this;
	}

	/**
	 * Get the onhashchange attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getOnHashChange() {
		return $this->getAttribute('onhashchange');
	}
}

