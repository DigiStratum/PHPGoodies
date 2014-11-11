<?php
/**
 * PHPGoodies:ScopeAttribute - SCOPE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * ScopeAttribute - SCOPE element attribute trait for NodeElements to easily use
 */
trait ScopeAttribute {
	/**
	 * Set the scope attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setScope($value) {
		$this->setAttribute('scope', $value);

		return $this;
	}

	/**
	 * Get the scope attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getScope() {
		return $this->getAttribute('scope');
	}
}

