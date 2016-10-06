<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_SrcSet - SRCSET element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * SrcSet - SRCSET element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_SrcSet {
	/**
	 * Set the srcset attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setSrcSet($value) {
		$this->setAttribute('srcset', $value);

		return $this;
	}

	/**
	 * Get the srcset attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getSrcSet() {
		return $this->getAttribute('srcset');
	}
}

