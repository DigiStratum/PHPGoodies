<?php
/**
 * PHPGoodies:CharAttribute - CHAR element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * CharAttribute - CHAR element attribute trait for NodeElements to easily use
 */
trait CharAttribute {
	/**
	 * Set the char attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setChar($value) {
		$this->setAttribute('char', $value);

		return $this;
	}

	/**
	 * Get the char attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getChar() {
		return $this->getAttribute('char');
	}
}

