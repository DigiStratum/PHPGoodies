<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_OnResize - ONRESIZE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * OnResize - ONRESIZE element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_OnResize {
	/**
	 * Set the onresize attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setOnResize($value) {
		$this->setAttribute('onresize', $value);

		return $this;
	}

	/**
	 * Get the onresize attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getOnResize() {
		return $this->getAttribute('onresize');
	}
}

