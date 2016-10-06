<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_VLink - VLINK element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * VLink - VLINK element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_VLink {
	/**
	 * Set the vlink attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setVLink($value) {
		$this->setAttribute('vlink', $value);

		return $this;
	}

	/**
	 * Get the vlink attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getVLink() {
		return $this->getAttribute('vlink');
	}
}

