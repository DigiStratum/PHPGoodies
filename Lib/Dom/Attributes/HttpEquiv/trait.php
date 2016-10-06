<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_HttpEquiv - HTTP-EQUIV element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * HttpEquiv - HTTP-EQUIV element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_HttpEquiv {
	/**
	 * Set the http-equiv attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setHttpEquiv($value) {
		$this->setAttribute('http-equiv', $value);

		return $this;
	}

	/**
	 * Get the http-equiv attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getHttpEquiv() {
		return $this->getAttribute('http-equiv');
	}
}

