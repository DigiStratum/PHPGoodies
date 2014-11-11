<?php
/**
 * PHPGoodies:SrcSetAttribute - SRCSET element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * SrcSetAttribute - SRCSET element attribute trait for NodeElements to easily use
 */
trait SrcSetAttribute {
	/**
	 * Set the srcset attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setSrcSet($value) {
		$this->setAttribute('srcset', $value);

		return $this;
	}

	/**
	 * Get the srcset attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getSrcSet() {
		return $this->getAttribute('srcset');
	}
}

