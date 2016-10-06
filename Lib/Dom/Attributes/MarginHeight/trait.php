<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_MarginHeight - MARGINHEIGHT element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * MarginHeight - MARGINHEIGHT element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_MarginHeight {
	/**
	 * Set the marginheight attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setMarginHeight($value) {
		$this->setAttribute('marginheight', $value);

		return $this;
	}

	/**
	 * Get the marginheight attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getMarginHeight() {
		return $this->getAttribute('marginheight');
	}
}

