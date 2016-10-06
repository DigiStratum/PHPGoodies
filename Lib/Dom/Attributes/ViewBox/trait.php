<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_ViewBox - VIEWBOX element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * ViewBox - VIEWBOX element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_ViewBox {
	/**
	 * Set the viewbox attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setViewBox($value) {
		$this->setAttribute('viewbox', $value);

		return $this;
	}

	/**
	 * Get the viewbox attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getViewBox() {
		return $this->getAttribute('viewbox');
	}
}

