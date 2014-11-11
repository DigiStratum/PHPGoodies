<?php
/**
 * PHPGoodies:StyleAttribute - STYLE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * StyleAttribute - STYLE element attribute trait for NodeElements to easily use
 */
trait StyleAttribute {
	/**
	 * Set the style attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setStyle($value) {
		$this->setAttribute('style', $value);

		return $this;
	}

	/**
	 * Get the style attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getStyle() {
		return $this->getAttribute('style');
	}
}

