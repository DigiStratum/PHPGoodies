<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Headers - HEADERS element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Headers - HEADERS element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Headers {
	/**
	 * Set the headers attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setHeaders($value) {
		$this->setAttribute('headers', $value);

		return $this;
	}

	/**
	 * Get the headers attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getHeaders() {
		return $this->getAttribute('headers');
	}
}

