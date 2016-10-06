<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_UseMap - USEMAP element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * UseMap - USEMAP element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_UseMap {
	/**
	 * Set the usemap attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setUseMap($value) {
		$this->setAttribute('usemap', $value);

		return $this;
	}

	/**
	 * Get the usemap attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getUseMap() {
		return $this->getAttribute('usemap');
	}
}

