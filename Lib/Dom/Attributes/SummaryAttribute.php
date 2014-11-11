<?php
/**
 * PHPGoodies:SummaryAttribute - SUMMARY element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * SummaryAttribute - SUMMARY element attribute trait for NodeElements to easily use
 */
trait SummaryAttribute {
	/**
	 * Set the summary attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setSummary($value) {
		$this->setAttribute('summary', $value);

		return $this;
	}

	/**
	 * Get the summary attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getSummary() {
		return $this->getAttribute('summary');
	}
}

