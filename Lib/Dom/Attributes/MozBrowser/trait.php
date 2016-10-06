<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_MozBrowser - MOZBROWSER element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * MozBrowser - MOZBROWSER element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_MozBrowser {
	/**
	 * Set the mozbrowser attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setMozBrowser($value) {
		$this->setAttribute('mozbrowser', $value);

		return $this;
	}

	/**
	 * Get the mozbrowser attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getMozBrowser() {
		return $this->getAttribute('mozbrowser');
	}
}

