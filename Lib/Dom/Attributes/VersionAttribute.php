<?php
/**
 * PHPGoodies:VersionAttribute - VERSION element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * VersionAttribute - VERSION element attribute trait for NodeElements to easily use
 */
trait VersionAttribute {
	/**
	 * Set the version attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setVersion($value) {
		$this->setAttribute('version', $value);

		return $this;
	}

	/**
	 * Get the version attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getVersion() {
		return $this->getAttribute('version');
	}
}

