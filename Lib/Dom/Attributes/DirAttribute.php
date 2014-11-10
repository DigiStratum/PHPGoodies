<?php
/**
 * PHPGoodies:DirAttribute - DIR element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * DirAttribute - DIR element attribute trait for NodeElements to easily use
 */
trait DirAttribute {
	/**
	 * Set the dir attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setDir($value) {
		$this->setAttribute('dir', $value);

		return $this;
	}

	/**
	 * Get the dir attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getDir() {
		return $this->getAttribute('dir');
	}
}

