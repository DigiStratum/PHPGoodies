<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_Draggable - DRAGGABLE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Draggable - DRAGGABLE element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_Draggable {
	/**
	 * Set the draggable attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setDraggable($value) {
		$this->setAttribute('draggable', $value);

		return $this;
	}

	/**
	 * Get the draggable attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getDraggable() {
		return $this->getAttribute('draggable');
	}
}

