<?php
/**
 * PHPGoodies:VAlignAttribute - VALIGN element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * VAlignAttribute - VALIGN element attribute trait for NodeElements to easily use
 */
trait VAlignAttribute {
	/**
	 * Set the valign attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setVAlign($value) {
		$this->setAttribute('valign', $value);

		return $this;
	}

	/**
	 * Get the valign attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getVAlign() {
		return $this->getAttribute('valign');
	}
}

