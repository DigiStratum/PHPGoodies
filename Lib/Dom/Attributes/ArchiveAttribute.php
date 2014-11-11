<?php
/**
 * PHPGoodies:ArchiveAttribute - ARCHIVE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * ArchiveAttribute - ARCHIVE element attribute trait for NodeElements to easily use
 */
trait ArchiveAttribute {
	/**
	 * Set the archive attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setArchive($value) {
		$this->setAttribute('archive', $value);

		return $this;
	}

	/**
	 * Get the archive attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getArchive() {
		return $this->getAttribute('archive');
	}
}

