<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Rel - REL element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Rel - REL element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Rel {
	/**
	 * Set the rel attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setRel($value) {
		$this->setAttribute('rel', $value);

		return $this;
	}

	/**
	 * Get the rel attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getRel() {
		return $this->getAttribute('rel');
	}
}

