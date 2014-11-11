<?php
/**
 * PHPGoodies:TabIndexAttribute - TABINDEX element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * TabIndexAttribute - TABINDEX element attribute trait for NodeElements to easily use
 */
trait TabIndexAttribute {
	/**
	 * Set the tabindex attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setTabIndex($value) {
		$this->setAttribute('tabindex', $value);

		return $this;
	}

	/**
	 * Get the tabindex attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getTabIndex() {
		return $this->getAttribute('tabindex');
	}
}

