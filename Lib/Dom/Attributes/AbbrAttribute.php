<?php
/**
 * PHPGoodies:AbbrAttribute - ABBR element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * AbbrAttribute - ABBR element attribute trait for NodeElements to easily use
 */
trait AbbrAttribute {
	/**
	 * Set the abbr attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setAbbr($value) {
		$this->setAttribute('abbr', $value);

		return $this;
	}

	/**
	 * Get the abbr attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getAbbr() {
		return $this->getAttribute('abbr');
	}
}

