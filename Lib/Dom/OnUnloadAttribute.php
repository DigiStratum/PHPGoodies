<?php
/**
 * PHPGoodies:OnUnloadAttribute - ONUNLOAD element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * OnUnloadAttribute - ONUNLOAD element attribute trait for NodeElements to easily use
 */
trait OnUnloadAttribute {
	/**
	 * Set the onunload attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setOnUnload($value) {
		$this->setAttribute('onunload', $value);

		return $this;
	}

	/**
	 * Get the onunload attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getOnUnload() {
		return $this->getAttribute('onunload');
	}
}

