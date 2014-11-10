<?php
/**
 * PHPGoodies:OnBeforeUnloadAttribute - ONBEFOREUNLOAD element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * OnBeforeUnloadAttribute - ONBEFOREUNLOAD element attribute trait for NodeElements to easily use
 */
trait OnBeforeUnloadAttribute {
	/**
	 * Set the onbeforeunload attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setOnBeforeUnload($value) {
		$this->setAttribute('onbeforeunload', $value);

		return $this;
	}

	/**
	 * Get the onbeforeunload attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getOnBeforeUnload() {
		return $this->getAttribute('onbeforeunload');
	}
}

