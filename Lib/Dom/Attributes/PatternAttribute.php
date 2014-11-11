<?php
/**
 * PHPGoodies:PatternAttribute - PATTERN element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * PatternAttribute - PATTERN element attribute trait for NodeElements to easily use
 */
trait PatternAttribute {
	/**
	 * Set the pattern attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setPattern($value) {
		$this->setAttribute('pattern', $value);

		return $this;
	}

	/**
	 * Get the pattern attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getPattern() {
		return $this->getAttribute('pattern');
	}
}

