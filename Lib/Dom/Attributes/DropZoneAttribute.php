<?php
/**
 * PHPGoodies:DropZoneAttribute - DROPZONE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * DropZoneAttribute - DROPZONE element attribute trait for NodeElements to easily use
 */
trait DropZoneAttribute {
	/**
	 * Set the dropzone attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setDropZone($value) {
		$this->setAttribute('dropzone', $value);

		return $this;
	}

	/**
	 * Get the dropzone attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getDropZone() {
		return $this->getAttribute('dropzone');
	}
}

