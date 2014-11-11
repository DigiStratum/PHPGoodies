<?php
/**
 * PHPGoodies:OnOnlineAttribute - ONONLINE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * OnOnlineAttribute - ONONLINE element attribute trait for NodeElements to easily use
 */
trait OnOnlineAttribute {
	/**
	 * Set the ononline attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setOnOnline($value) {
		$this->setAttribute('ononline', $value);

		return $this;
	}

	/**
	 * Get the ononline attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getOnOnline() {
		return $this->getAttribute('ononline');
	}
}

