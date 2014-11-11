<?php
/**
 * PHPGoodies:MozActionHintAttribute - MOZACTIONHINT element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * MozActionHintAttribute - MOZACTIONHINT element attribute trait for NodeElements to easily use
 */
trait MozActionHintAttribute {
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

