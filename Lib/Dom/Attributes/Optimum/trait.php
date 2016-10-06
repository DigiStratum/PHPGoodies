<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Optimum - OPTIMUM element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Optimum - OPTIMUM element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Optimum {
	/**
	 * Set the optimum attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setOptimum($value) {
		$this->setAttribute('optimum', $value);

		return $this;
	}

	/**
	 * Get the optimum attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getOptimum() {
		return $this->getAttribute('optimum');
	}
}

