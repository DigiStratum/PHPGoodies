<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_ContentStyleType - CONTENTSTYLETYPE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * ContentStyleType - CONTENTSTYLETYPE element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_ContentStyleType {
	/**
	 * Set the contentstyletype attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setContentStyleType($value) {
		$this->setAttribute('contentstyletype', $value);

		return $this;
	}

	/**
	 * Get the contentstyletype attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getContentStyleType() {
		return $this->getAttribute('contentstyletype');
	}
}

