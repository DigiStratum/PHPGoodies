<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Frame - FRAME element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Frame - FRAME element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Frame {
	/**
	 * Set the frame attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setFrame($value) {
		$this->setAttribute('frame', $value);

		return $this;
	}

	/**
	 * Get the frame attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getFrame() {
		return $this->getAttribute('frame');
	}
}

