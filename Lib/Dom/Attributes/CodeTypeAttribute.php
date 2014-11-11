<?php
/**
 * PHPGoodies:CodeTypeAttribute - CODETYPE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * CodeTypeAttribute - CODETYPE element attribute trait for NodeElements to easily use
 */
trait CodeTypeAttribute {
	/**
	 * Set the codetype attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setCodeType($value) {
		$this->setAttribute('codetype', $value);

		return $this;
	}

	/**
	 * Get the codetype attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getCodeType() {
		return $this->getAttribute('codetype');
	}
}

