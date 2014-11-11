<?php
/**
 * PHPGoodies:ClassIdAttribute - CLASSID element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * ClassIdAttribute - CLASSID element attribute trait for NodeElements to easily use
 */
trait ClassIdAttribute {
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

