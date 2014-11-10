<?php
/**
 * PHPGoodies:WidthAttribute - WIDTH element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * WidthAttribute - WIDTH element attribute trait for NodeElements to easily use
 */
trait WidthAttribute {
	/**
	 * Set the width attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setWidth($value) {
		$this->setAttribute('width', $value);

		return $this;
	}

	/**
	 * Get the width attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getWidth() {
		return $this->getAttribute('width');
	}
}

