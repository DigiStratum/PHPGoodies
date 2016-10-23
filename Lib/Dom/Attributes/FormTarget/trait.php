<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_FormTarget - FORMTARGET element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * FormTarget - FORMTARGET element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_FormTarget {
	/**
	 * Set the formtarget attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setFormTarget($value) {
		$this->setAttribute('formtarget', $value);

		return $this;
	}

	/**
	 * Get the formtarget attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getFormTarget() {
		return $this->getAttribute('formtarget');
	}
}
