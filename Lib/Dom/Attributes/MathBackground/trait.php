<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_MathBackground - MATHBACKGROUND element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * MathBackground - MATHBACKGROUND element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_MathBackground {
	/**
	 * Set the mathbackground attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setMathBackground($value) {
		$this->setAttribute('mathbackground', $value);

		return $this;
	}

	/**
	 * Get the mathbackground attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getMathBackground() {
		return $this->getAttribute('mathbackground');
	}
}

