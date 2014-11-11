<?php
/**
 * PHPGoodies:ValueTypeAttribute - VALUETYPE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * ValueTypeAttribute - VALUETYPE element attribute trait for NodeElements to easily use
 */
trait ValueTypeAttribute {
	/**
	 * Set the valuetype attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setValueType($value) {
		$this->setAttribute('valuetype', $value);

		return $this;
	}

	/**
	 * Get the valuetype attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getValueType() {
		return $this->getAttribute('valuetype');
	}
}

