<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_OnOffline - ONOFFLINE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * OnOffline - ONOFFLINE element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_OnOffline {
	/**
	 * Set the onoffline attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setOnOffline($value) {
		$this->setAttribute('onoffline', $value);

		return $this;
	}

	/**
	 * Get the onoffline attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getOnOffline() {
		return $this->getAttribute('onoffline');
	}
}

