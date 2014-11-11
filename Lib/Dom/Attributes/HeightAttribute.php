<?php
/**
 * PHPGoodies:HeightAttribute - HEIGHT element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * HeightAttribute - HEIGHT element attribute trait for NodeElements to easily use
 */
trait HeightAttribute {
	/**
	 * Set the height attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setHeight($value) {
		$this->setAttribute('height', $value);

		return $this;
	}

	/**
	 * Get the height attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getHeight() {
		return $this->getAttribute('height');
	}
}

