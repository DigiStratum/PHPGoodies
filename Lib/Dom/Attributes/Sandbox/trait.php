<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Sandbox - SANDBOX element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Sandbox - SANDBOX element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Sandbox {
	/**
	 * Set the sandbox attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setSandbox($value) {
		$this->setAttribute('sandbox', $value);

		return $this;
	}

	/**
	 * Get the sandbox attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getSandbox() {
		return $this->getAttribute('sandbox');
	}
}

