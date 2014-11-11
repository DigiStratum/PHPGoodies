<?php
/**
 * PHPGoodies:LoopAttribute - LOOP element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * LoopAttribute - LOOP element attribute trait for NodeElements to easily use
 */
trait LoopAttribute {
	/**
	 * Set the loop attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setLoop($value) {
		$this->setAttribute('loop', $value);

		return $this;
	}

	/**
	 * Get the loop attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getLoop() {
		return $this->getAttribute('loop');
	}
}

