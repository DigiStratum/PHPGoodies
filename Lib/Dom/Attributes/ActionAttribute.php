<?php
/**
 * PHPGoodies:ActionAttribute - ACTION element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * ActionAttribute - ACTION element attribute trait for NodeElements to easily use
 */
trait ActionAttribute {
	/**
	 * Set the action attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setAction($value) {
		$this->setAttribute('action', $value);

		return $this;
	}

	/**
	 * Get the action attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getAction() {
		return $this->getAttribute('action');
	}
}

