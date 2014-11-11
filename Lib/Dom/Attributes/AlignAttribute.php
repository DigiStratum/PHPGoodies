<?php
/**
 * PHPGoodies:AlignAttribute - ALIGN element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * AlignAttribute - ALIGN element attribute trait for NodeElements to easily use
 */
trait AlignAttribute {
	/**
	 * Set the align attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setAlign($value) {
		$this->setAttribute('align', $value);

		return $this;
	}

	/**
	 * Get the align attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getAlign() {
		return $this->getAttribute('align');
	}
}

