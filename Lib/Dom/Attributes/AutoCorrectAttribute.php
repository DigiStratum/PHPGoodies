<?php
/**
 * PHPGoodies:AutoCorrectAttribute - AUTOCORRECT element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * AutoCorrectAttribute - AUTOCORRECT element attribute trait for NodeElements to easily use
 */
trait AutoCorrectAttribute {
	/**
	 * Set the autocorrect attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setAutoCorrect($value) {
		$this->setAttribute('autocorrect', $value);

		return $this;
	}

	/**
	 * Get the autocorrect attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getAutoCorrect() {
		return $this->getAttribute('autocorrect');
	}
}

