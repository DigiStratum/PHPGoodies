<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Content - CONTENT element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Content - CONTENT element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Content {
	/**
	 * Set the content attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setContent($value) {
		$this->setAttribute('content', $value);

		return $this;
	}

	/**
	 * Get the content attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getContent() {
		return $this->getAttribute('content');
	}
}

