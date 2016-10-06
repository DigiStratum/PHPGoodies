<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Downloads - DOWNLOADS element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Downloads - DOWNLOADS element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Downloads {
	/**
	 * Set the downloads attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setDownloads($value) {
		$this->setAttribute('downloads', $value);

		return $this;
	}

	/**
	 * Get the downloads attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getDownloads() {
		return $this->getAttribute('downloads');
	}
}

