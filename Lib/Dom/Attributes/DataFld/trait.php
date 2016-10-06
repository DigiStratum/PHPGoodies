<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_DataFld - DATAFLD element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * DataFld - DATAFLD element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_DataFld {
	/**
	 * Set the datafld attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setDataFld($value) {
		$this->setAttribute('datafld', $value);

		return $this;
	}

	/**
	 * Get the datafld attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getDataFld() {
		return $this->getAttribute('datafld');
	}
}

