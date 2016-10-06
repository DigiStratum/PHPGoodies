<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_OnStorage - ONSTORAGE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * OnStorage - ONSTORAGE element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_OnStorage {
	/**
	 * Set the onstorage attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setOnStorage($value) {
		$this->setAttribute('onstorage', $value);

		return $this;
	}

	/**
	 * Get the onstorage attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getOnStorage() {
		return $this->getAttribute('onstorage');
	}
}

