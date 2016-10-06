<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_MozActionHint - MOZACTIONHINT element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * MozActionHint - MOZACTIONHINT element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_MozActionHint {
	/**
	 * Set the mozactionhint attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setMozActionHint($value) {
		$this->setAttribute('mozactionhint', $value);

		return $this;
	}

	/**
	 * Get the mozactionhint attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getMozActionHint() {
		return $this->getAttribute('mozactionhint');
	}
}

