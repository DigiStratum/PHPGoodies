<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_ContextMenu - CONTEXTMENU element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * ContextMenu - CONTEXTMENU element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_ContextMenu {
	/**
	 * Set the contextmenu attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setContextMenu($value) {
		$this->setAttribute('contextmenu', $value);

		return $this;
	}

	/**
	 * Get the contextmenu attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getContextMenu() {
		return $this->getAttribute('contextmenu');
	}
}

