<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_TopMargin - TOPMARGIN element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * TopMargin - TOPMARGIN element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_TopMargin {
	/**
	 * Set the topmargin attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setTopMargin($value) {
		$this->setAttribute('topmargin', $value);

		return $this;
	}

	/**
	 * Get the topmargin attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getTopMargin() {
		return $this->getAttribute('topmargin');
	}
}

