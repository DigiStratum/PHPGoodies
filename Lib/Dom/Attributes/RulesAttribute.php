<?php
/**
 * PHPGoodies:RulesAttribute - RULES element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * RulesAttribute - RULES element attribute trait for NodeElements to easily use
 */
trait RulesAttribute {
	/**
	 * Set the rules attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setRules($value) {
		$this->setAttribute('rules', $value);

		return $this;
	}

	/**
	 * Get the rules attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getRules() {
		return $this->getAttribute('rules');
	}
}

