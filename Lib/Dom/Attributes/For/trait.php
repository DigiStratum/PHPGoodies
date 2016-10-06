<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_For - FOR element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * For - FOR element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_For {
	/**
	 * Set the for attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setFor($value) {
		$this->setAttribute('for', $value);

		return $this;
	}

	/**
	 * Get the for attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getFor() {
		return $this->getAttribute('for');
	}
}

