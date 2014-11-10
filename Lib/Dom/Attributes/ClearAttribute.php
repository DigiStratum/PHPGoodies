<?php
/**
 * PHPGoodies:ClearAttribute - CLEAR element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * ClearAttribute - CLEAR element attribute trait for NodeElements to easily use
 */
trait ClearAttribute {
	/**
	 * Set the clear attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setClear($value) {
		$this->setAttribute('clear', $value);

		return $this;
	}

	/**
	 * Get the clear attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getClear() {
		return $this->getAttribute('clear');
	}
}

