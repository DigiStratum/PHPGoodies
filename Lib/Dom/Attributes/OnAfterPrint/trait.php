<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_OnAfterPrint - ONAFTERPRINT element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * OnAfterPrint - ONAFTERPRINT element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_OnAfterPrint {
	/**
	 * Set the onafterprint attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setOnAfterPrint($value) {
		$this->setAttribute('onafterprint', $value);

		return $this;
	}

	/**
	 * Get the onafterprint attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getOnAfterPrint() {
		return $this->getAttribute('onafterprint');
	}
}

