<?php
/**
 * PHPGoodies:DisabledAttribute - DISABLED element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * DisabledAttribute - DISABLED element attribute trait for NodeElements to easily use
 */
trait DisabledAttribute {
	/**
	 * Set the disabled attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setDisabled($value) {
		$this->setAttribute('disabled', $value);

		return $this;
	}

	/**
	 * Get the disabled attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getDisabled() {
		return $this->getAttribute('disabled');
	}
}

