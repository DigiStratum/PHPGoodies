<?php
/**
 * PHPGoodies:OnPopStateAttribute - ONPOPSTATE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * OnPopStateAttribute - ONPOPSTATE element attribute trait for NodeElements to easily use
 */
trait OnPopStateAttribute {
	/**
	 * Set the onpopstate attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setOnPopState($value) {
		$this->setAttribute('onpopstate', $value);

		return $this;
	}

	/**
	 * Get the onpopstate attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getOnPopState() {
		return $this->getAttribute('onpopstate');
	}
}

