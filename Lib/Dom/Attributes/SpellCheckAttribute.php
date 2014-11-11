<?php
/**
 * PHPGoodies:SpellCheckAttribute - SPELLCHECK element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * SpellCheckAttribute - SPELLCHECK element attribute trait for NodeElements to easily use
 */
trait SpellCheckAttribute {
	/**
	 * Set the spellcheck attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setSpellCheck($value) {
		$this->setAttribute('spellcheck', $value);

		return $this;
	}

	/**
	 * Get the spellcheck attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getSpellCheck() {
		return $this->getAttribute('spellcheck');
	}
}

