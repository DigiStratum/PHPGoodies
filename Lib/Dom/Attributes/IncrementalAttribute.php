<?php
/**
 * PHPGoodies:IncrementalAttribute - INCREMENTAL element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * IncrementalAttribute - INCREMENTAL element attribute trait for NodeElements to easily use
 */
trait IncrementalAttribute {
	/**
	 * Set the incremental attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setIncremental($value) {
		$this->setAttribute('incremental', $value);

		return $this;
	}

	/**
	 * Get the incremental attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getIncremental() {
		return $this->getAttribute('incremental');
	}
}

