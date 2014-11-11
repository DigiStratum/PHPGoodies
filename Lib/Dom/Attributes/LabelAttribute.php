<?php
/**
 * PHPGoodies:LabelAttribute - LABEL element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * LabelAttribute - LABEL element attribute trait for NodeElements to easily use
 */
trait LabelAttribute {
	/**
	 * Set the label attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setLabel($value) {
		$this->setAttribute('label', $value);

		return $this;
	}

	/**
	 * Get the label attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getLabel() {
		return $this->getAttribute('label');
	}
}

