<?php
/**
 * PHPGoodies:MozOpaqueAttribute - MOZ-OPAQUE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * MozOpaqueAttribute - MOZ-OPAQUE element attribute trait for NodeElements to easily use
 */
trait MozOpaqueAttribute {
	/**
	 * Set the moz-opaque attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setMozOpaque($value) {
		$this->setAttribute('moz-opaque', $value);

		return $this;
	}

	/**
	 * Get the moz-opaque attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getMozOpaque() {
		return $this->getAttribute('moz-opaque');
	}
}

