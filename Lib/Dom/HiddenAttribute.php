<?php
/**
 * PHPGoodies:HhiddendenAttribute - HIDDEN element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * HhiddendenAttribute - HIDDEN element attribute trait for NodeElements to easily use
 */
trait HhiddendenAttribute {
	/**
	 * Set the hidden attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setHhiddenden($value) {
		$this->setAttribute('hidden', $value);

		return $this;
	}

	/**
	 * Get the hidden attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getHhiddenden() {
		return $this->getAttribute('hidden');
	}
}

