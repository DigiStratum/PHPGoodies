<?php
/**
 * PHPGoodies:DeclareAttribute - DECLARE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * DeclareAttribute - DECLARE element attribute trait for NodeElements to easily use
 */
trait DeclareAttribute {
	/**
	 * Set the declare attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setDeclare($value) {
		$this->setAttribute('declare', $value);

		return $this;
	}

	/**
	 * Get the declare attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getDeclare() {
		return $this->getAttribute('declare');
	}
}

