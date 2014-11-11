<?php
/**
 * PHPGoodies:OnLoadAttribute - ONLOAD element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * OnLoadAttribute - ONLOAD element attribute trait for NodeElements to easily use
 */
trait OnLoadAttribute {
	/**
	 * Set the onload attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setOnLoad($value) {
		$this->setAttribute('onload', $value);

		return $this;
	}

	/**
	 * Get the onload attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getOnLoad() {
		return $this->getAttribute('onload');
	}
}

