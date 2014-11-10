<?php
/**
 * PHPGoodies:DownloadAttribute - DOWNLOAD element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * DownloadAttribute - DOWNLOAD element attribute trait for NodeElements to easily use
 */
trait DownloadAttribute {
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

