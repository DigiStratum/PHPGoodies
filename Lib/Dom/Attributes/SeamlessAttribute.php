<?php
/**
 * PHPGoodies:SeamlessAttribute - SEAMLESS element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * SeamlessAttribute - SEAMLESS element attribute trait for NodeElements to easily use
 */
trait SeamlessAttribute {
	/**
	 * Set the seamless attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setSeamless($value) {
		$this->setAttribute('seamless', $value);

		return $this;
	}

	/**
	 * Get the seamless attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getSeamless() {
		return $this->getAttribute('seamless');
	}
}

