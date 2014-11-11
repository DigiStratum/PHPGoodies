<?php
/**
 * PHPGoodies:SelectedAttribute - SELECTED element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * SelectedAttribute - SELECTED element attribute trait for NodeElements to easily use
 */
trait SelectedAttribute {
	/**
	 * Set the selected attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setSelected($value) {
		$this->setAttribute('selected', $value);

		return $this;
	}

	/**
	 * Get the selected attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getSelected() {
		return $this->getAttribute('selected');
	}
}

