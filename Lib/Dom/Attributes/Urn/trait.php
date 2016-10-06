<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Urn - URN element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Urn - URN element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Urn {
	/**
	 * Set the urn attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setUrn($value) {
		$this->setAttribute('urn', $value);

		return $this;
	}

	/**
	 * Get the urn attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getUrn() {
		return $this->getAttribute('urn');
	}
}

