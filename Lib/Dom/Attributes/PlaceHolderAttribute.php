<?php
/**
 * PHPGoodies:PlaceHolderAttribute - PLACEHOLDER element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * PlaceHolderAttribute - PLACEHOLDER element attribute trait for NodeElements to easily use
 */
trait PlaceHolderAttribute {
	/**
	 * Set the placeholder attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setPlaceHolder($value) {
		$this->setAttribute('placeholder', $value);

		return $this;
	}

	/**
	 * Get the placeholder attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getPlaceHolder() {
		return $this->getAttribute('placeholder');
	}
}

