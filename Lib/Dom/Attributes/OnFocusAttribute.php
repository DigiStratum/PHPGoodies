<?php
/**
 * PHPGoodies:OnFocusAttribute - ONFOCUS element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * OnFocusAttribute - ONFOCUS element attribute trait for NodeElements to easily use
 */
trait OnFocusAttribute {
	/**
	 * Set the onfocus attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setOnFocus($value) {
		$this->setAttribute('onfocus', $value);

		return $this;
	}

	/**
	 * Get the onfocus attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getOnFocus() {
		return $this->getAttribute('onfocus');
	}
}

