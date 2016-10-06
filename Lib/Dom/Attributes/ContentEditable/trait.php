<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_ContentEditable - CONTENTEDITABLE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * ContentEditable - CONTENTEDITABLE element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_ContentEditable {
	/**
	 * Set the contenteditable attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setContentEditable($value) {
		$this->setAttribute('contenteditable', $value);

		return $this;
	}

	/**
	 * Get the contenteditable attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getContentEditable() {
		return $this->getAttribute('contenteditable');
	}
}

