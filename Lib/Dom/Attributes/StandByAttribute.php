<?php
/**
 * PHPGoodies:StandByAttribute - STANDBY element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * StandByAttribute - STANDBY element attribute trait for NodeElements to easily use
 */
trait StandByAttribute {
	/**
	 * Set the standby attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setStandBy($value) {
		$this->setAttribute('standby', $value);

		return $this;
	}

	/**
	 * Get the standby attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getStandBy() {
		return $this->getAttribute('standby');
	}
}

