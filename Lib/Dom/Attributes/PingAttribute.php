<?php
/**
 * PHPGoodies:PingAttribute - PING element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * PingAttribute - PING element attribute trait for NodeElements to easily use
 */
trait PingAttribute {
	/**
	 * Set the ping attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setPing($value) {
		$this->setAttribute('ping', $value);

		return $this;
	}

	/**
	 * Get the ping attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getPing() {
		return $this->getAttribute('ping');
	}
}

