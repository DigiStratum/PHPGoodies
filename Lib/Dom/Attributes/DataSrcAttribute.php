<?php
/**
 * PHPGoodies:DataSrcAttribute - DATASRC element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * DataSrcAttribute - DATASRC element attribute trait for NodeElements to easily use
 */
trait DataSrcAttribute {
	/**
	 * Set the datasrc attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setDataSrc($value) {
		$this->setAttribute('datasrc', $value);

		return $this;
	}

	/**
	 * Get the datasrc attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getDataSrc() {
		return $this->getAttribute('datasrc');
	}
}
