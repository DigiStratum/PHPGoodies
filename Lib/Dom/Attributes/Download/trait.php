<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Download - DOWNLOAD element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Download - DOWNLOAD element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Download {
	/**
	 * Set the download attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setDownload($value) {
		$this->setAttribute('download', $value);

		return $this;
	}

	/**
	 * Get the download attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getDownload() {
		return $this->getAttribute('download');
	}
}

