<?php
/**
 * PHPGoodies:LinkAttribute - LINK element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * LinkAttribute - LINK element attribute trait for NodeElements to easily use
 */
trait LinkAttribute {
	/**
	 * Set the link attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setLink($value) {
		$this->setAttribute('link', $value);

		return $this;
	}

	/**
	 * Get the link attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getLink() {
		return $this->getAttribute('link');
	}
}

