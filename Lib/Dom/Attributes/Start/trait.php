<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Start - START element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Start - START element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Start {
	/**
	 * Set the start attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setStart($value) {
		$this->setAttribute('start', $value);

		return $this;
	}

	/**
	 * Get the start attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getStart() {
		return $this->getAttribute('start');
	}
}
