<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Step - STEP element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Step - STEP element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Step {
	/**
	 * Set the step attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setStep($value) {
		$this->setAttribute('step', $value);

		return $this;
	}

	/**
	 * Get the step attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getStep() {
		return $this->getAttribute('step');
	}
}

