<?php
/**
 * PHPGoodies:FormEncTypeAttribute - FORMENCTYPE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * FormEncTypeAttribute - FORMENCTYPE element attribute trait for NodeElements to easily use
 */
trait FormEncTypeAttribute {
	/**
	 * Set the formenctype attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setFormEncType($value) {
		$this->setAttribute('formenctype', $value);

		return $this;
	}

	/**
	 * Get the formenctype attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getFormEncType() {
		return $this->getAttribute('formenctype');
	}
}

