<?php
/**
 * PHPGoodies:ScrollingAttribute - SCROLLING element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * ScrollingAttribute - SCROLLING element attribute trait for NodeElements to easily use
 */
trait ScrollingAttribute {
	/**
	 * Set the scrolling attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setScrolling($value) {
		$this->setAttribute('scrolling', $value);

		return $this;
	}

	/**
	 * Get the scrolling attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getScrolling() {
		return $this->getAttribute('scrolling');
	}
}

