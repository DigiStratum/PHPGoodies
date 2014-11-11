<?php
/**
 * PHPGoodies:AutoSaveAttribute - AUTOSAVE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * AutoSaveAttribute - AUTOSAVE element attribute trait for NodeElements to easily use
 */
trait AutoSaveAttribute {
	/**
	 * Set the autosave attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setAutoSave($value) {
		$this->setAttribute('autosave', $value);

		return $this;
	}

	/**
	 * Get the autosave attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getAutoSave() {
		return $this->getAttribute('autosave');
	}
}

