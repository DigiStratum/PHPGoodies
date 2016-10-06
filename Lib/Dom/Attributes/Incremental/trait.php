<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Incremental - INCREMENTAL element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Incremental - INCREMENTAL element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Incremental {
	/**
	 * Set the incremental attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setIncremental($value) {
		$this->setAttribute('incremental', $value);

		return $this;
	}

	/**
	 * Get the incremental attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getIncremental() {
		return $this->getAttribute('incremental');
	}
}

