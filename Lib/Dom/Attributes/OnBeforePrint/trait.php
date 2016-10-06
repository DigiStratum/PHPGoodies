<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_OnBeforePrint - ONBEFOREPRINT element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * OnBeforePrint - ONBEFOREPRINT element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_OnBeforePrint {
	/**
	 * Set the onbeforeprint attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setOnBeforePrint($value) {
		$this->setAttribute('onbeforeprint', $value);

		return $this;
	}

	/**
	 * Get the onbeforeprint attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getOnBeforePrint() {
		return $this->getAttribute('onbeforeprint');
	}
}

