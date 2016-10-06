<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_HSpace - HSPACE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * HSpace - HSPACE element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_HSpace {
	/**
	 * Set the hspace attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setHSpace($value) {
		$this->setAttribute('hspace', $value);

		return $this;
	}

	/**
	 * Get the hspace attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getHSpace() {
		return $this->getAttribute('hspace');
	}
}

