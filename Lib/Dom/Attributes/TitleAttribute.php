<?php
/**
 * PHPGoodies:TitleAttribute - TITLE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * TitleAttribute - TITLE element attribute trait for NodeElements to easily use
 */
trait TitleAttribute {
	/**
	 * Set the title attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setTitle($value) {
		$this->setAttribute('title', $value);

		return $this;
	}

	/**
	 * Get the title attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getTitle() {
		return $this->getAttribute('title');
	}
}

