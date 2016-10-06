<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_AcceptCharSet - ACCEPTCHARSET element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * AcceptCharSet - ACCEPTCHARSET element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_AcceptCharSet {
	/**
	 * Set the acceptcharset attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setAcceptCharSet($value) {
		$this->setAttribute('acceptcharset', $value);

		return $this;
	}

	/**
	 * Get the acceptcharset attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getAcceptCharSet() {
		return $this->getAttribute('acceptcharset');
	}
}

