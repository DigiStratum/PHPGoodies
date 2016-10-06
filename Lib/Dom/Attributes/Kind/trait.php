<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Kind - KIND element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Kind - KIND element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Kind {
	/**
	 * Set the kind attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setKind($value) {
		$this->setAttribute('kind', $value);

		return $this;
	}

	/**
	 * Get the kind attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getKind() {
		return $this->getAttribute('kind');
	}
}

