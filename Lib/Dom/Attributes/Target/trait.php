<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Target - TARGET element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Target - TARGET element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Target {
	/**
	 * Set the target attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setTarget($value) {
		$this->setAttribute('target', $value);

		return $this;
	}

	/**
	 * Get the target attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getTarget() {
		return $this->getAttribute('target');
	}
}

