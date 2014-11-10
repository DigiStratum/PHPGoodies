<?php
/**
 * PHPGoodies:OnMessageAttribute - ONMESSAGE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * OnMessageAttribute - ONMESSAGE element attribute trait for NodeElements to easily use
 */
trait OnMessageAttribute {
	/**
	 * Set the onmessage attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setOnMessage($value) {
		$this->setAttribute('onmessage', $value);

		return $this;
	}

	/**
	 * Get the onmessage attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getOnMessage() {
		return $this->getAttribute('onmessage');
	}
}

