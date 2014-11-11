<?php
/**
 * PHPGoodies:ListAttribute - LIST element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * ListAttribute - LIST element attribute trait for NodeElements to easily use
 */
trait ListAttribute {
	/**
	 * Set the list attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setList($value) {
		$this->setAttribute('list', $value);

		return $this;
	}

	/**
	 * Get the list attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getList() {
		return $this->getAttribute('list');
	}
}

