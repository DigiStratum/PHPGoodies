<?php
/**
 * PHPGoodies:NoHrefAttribute - NOHREF element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * NoHrefAttribute - NOHREF element attribute trait for NodeElements to easily use
 */
trait NoHrefAttribute {
	/**
	 * Set the nohref attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setNoHref($value) {
		$this->setAttribute('nohref', $value);

		return $this;
	}

	/**
	 * Get the nohref attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getNoHref() {
		return $this->getAttribute('nohref');
	}
}

