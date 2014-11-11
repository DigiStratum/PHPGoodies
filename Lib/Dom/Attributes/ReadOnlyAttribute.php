<?php
/**
 * PHPGoodies:ReadOnlyAttribute - READONLY element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * ReadOnlyAttribute - READONLY element attribute trait for NodeElements to easily use
 */
trait ReadOnlyAttribute {
	/**
	 * Set the readonly attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setReadOnly($value) {
		$this->setAttribute('readonly', $value);

		return $this;
	}

	/**
	 * Get the readonly attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getReadOnly() {
		return $this->getAttribute('readonly');
	}
}

