<?php
/**
 * PHPGoodies:ScopedAttribute - SCOPED element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * ScopedAttribute - SCOPED element attribute trait for NodeElements to easily use
 */
trait ScopedAttribute {
	/**
	 * Set the scoped attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setScoped($value) {
		$this->setAttribute('scoped', $value);

		return $this;
	}

	/**
	 * Get the scoped attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getScoped() {
		return $this->getAttribute('scoped');
	}
}

