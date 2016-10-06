<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_ClassId - CLASSID element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * ClassId - CLASSID element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_ClassId {
	/**
	 * Set the classid attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setClassId($value) {
		$this->setAttribute('classid', $value);

		return $this;
	}

	/**
	 * Get the classid attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getClassId() {
		return $this->getAttribute('classid');
	}
}

