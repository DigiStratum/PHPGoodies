<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_VSpace - VSPACE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * VSpace - VSPACE element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_VSpace {
	/**
	 * Set the vspace attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setVSpace($value) {
		$this->setAttribute('vspace', $value);

		return $this;
	}

	/**
	 * Get the vspace attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getVSpace() {
		return $this->getAttribute('vspace');
	}
}

