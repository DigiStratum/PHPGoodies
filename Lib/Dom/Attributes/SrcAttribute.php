<?php
/**
 * PHPGoodies:SrcAttribute - SRC element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * SrcAttribute - SRC element attribute trait for NodeElements to easily use
 */
trait SrcAttribute {
	/**
	 * Set the src attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setSrc($value) {
		$this->setAttribute('src', $value);

		return $this;
	}

	/**
	 * Get the src attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getSrc() {
		return $this->getAttribute('src');
	}
}

