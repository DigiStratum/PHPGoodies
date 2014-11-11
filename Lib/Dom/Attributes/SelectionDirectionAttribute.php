<?php
/**
 * PHPGoodies:SelectionDirectionAttribute - SELECTIONDIRECTION element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * SelectionDirectionAttribute - SELECTIONDIRECTION element attribute trait for NodeElements to easily use
 */
trait SelectionDirectionAttribute {
	/**
	 * Set the selectiondirection attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setSelectionDirection($value) {
		$this->setAttribute('selectiondirection', $value);

		return $this;
	}

	/**
	 * Get the selectiondirection attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getSelectionDirection() {
		return $this->getAttribute('selectiondirection');
	}
}

