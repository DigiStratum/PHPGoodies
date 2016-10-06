<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_ContentScriptType - CONTENTSCRIPTTYPE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * ContentScriptType - CONTENTSCRIPTTYPE element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_ContentScriptType {
	/**
	 * Set the contentscripttype attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setContentScriptType($value) {
		$this->setAttribute('contentscripttype', $value);

		return $this;
	}

	/**
	 * Get the contentscripttype attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getContentScriptType() {
		return $this->getAttribute('contentscripttype');
	}
}

