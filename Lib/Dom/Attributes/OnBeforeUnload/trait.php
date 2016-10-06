<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_OnBeforeUnload - ONBEFOREUNLOAD element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * OnBeforeUnload - ONBEFOREUNLOAD element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_OnBeforeUnload {
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

