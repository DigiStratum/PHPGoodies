<?php
/**
 * PHPGoodies:OnHashChangeAttribute - ONHASHCHANGE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * OnHashChangeAttribute - ONHASHCHANGE element attribute trait for NodeElements to easily use
 */
trait OnHashChangeAttribute {
	/**
	 * Set the onhashchange attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setOnHashChange($value) {
		$this->setAttribute('onhashchange', $value);

		return $this;
	}

	/**
	 * Get the onhashchange attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getOnHashChange() {
		return $this->getAttribute('onhashchange');
	}
}

