<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_ALink - ALINK element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * ALink - ALINK element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_ALink {
	/**
	 * Set the alink attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setALink($value) {
		$this->setAttribute('alink', $value);

		return $this;
	}

	/**
	 * Get the alink attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getALink() {
		return $this->getAttribute('alink');
	}
}

