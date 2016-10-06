<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_LongDesc - LONGDESC element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * LongDesc - LONGDESC element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_LongDesc {
	/**
	 * Set the longdesc attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setLongDesc($value) {
		$this->setAttribute('longdesc', $value);

		return $this;
	}

	/**
	 * Get the longdesc attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getLongDesc() {
		return $this->getAttribute('longdesc');
	}
}

