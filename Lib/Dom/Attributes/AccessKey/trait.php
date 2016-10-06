<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_AccessKey - ACCESSKEY element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * AccessKey - ACCESSKEY element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_AccessKey {
	/**
	 * Set the accesskey attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setAccessKey($value) {
		$this->setAttribute('accesskey', $value);

		return $this;
	}

	/**
	 * Get the accesskey attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getAccessKey() {
		return $this->getAttribute('accesskey');
	}
}

