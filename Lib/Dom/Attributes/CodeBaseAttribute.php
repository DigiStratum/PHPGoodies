<?php
/**
 * PHPGoodies:CodeBaseAttribute - CODEBASE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * CodeBaseAttribute - CODEBASE element attribute trait for NodeElements to easily use
 */
trait CodeBaseAttribute {
	/**
	 * Set the codebase attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setCodeBase($value) {
		$this->setAttribute('codebase', $value);

		return $this;
	}

	/**
	 * Get the codebase attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getCodeBase() {
		return $this->getAttribute('codebase');
	}
}

