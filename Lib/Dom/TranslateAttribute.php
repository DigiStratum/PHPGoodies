<?php
/**
 * PHPGoodies:TranslateAttribute - TRANSLATE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * TranslateAttribute - TRANSLATE element attribute trait for NodeElements to easily use
 */
trait TranslateAttribute {
	/**
	 * Set the translate attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setTranslate($value) {
		$this->setAttribute('translate', $value);

		return $this;
	}

	/**
	 * Get the translate attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getTranslate() {
		return $this->getAttribute('translate');
	}
}

