<?php
/**
 * PHPGoodies:RemoteAttribute - REMOTE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * RemoteAttribute - REMOTE element attribute trait for NodeElements to easily use
 */
trait RemoteAttribute {
	/**
	 * Set the remote attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setRemote($value) {
		$this->setAttribute('remote', $value);

		return $this;
	}

	/**
	 * Get the remote attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getRemote() {
		return $this->getAttribute('remote');
	}
}

