<?php
/**
 * PHPGoodies:HrefAttribute - HREF element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * HrefAttribute - HREF element attribute trait for NodeElements to easily use
 */
trait HrefAttribute {
	/**
	 * Set the href attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setHref($value) {
		$this->setAttribute('href', $value);

		return $this;
	}

	/**
	 * Get the href attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getHref() {
		return $this->getAttribute('href');
	}
}

