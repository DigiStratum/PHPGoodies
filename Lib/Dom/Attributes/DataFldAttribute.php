<?php
/**
 * PHPGoodies:DataFldAttribute - DATAFLD element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * DataFldAttribute - DATAFLD element attribute trait for NodeElements to easily use
 */
trait DataFldAttribute {
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

