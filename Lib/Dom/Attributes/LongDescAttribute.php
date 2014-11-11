<?php
/**
 * PHPGoodies:LongDescAttribute - LONGDESC element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * LongDescAttribute - LONGDESC element attribute trait for NodeElements to easily use
 */
trait LongDescAttribute {
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
