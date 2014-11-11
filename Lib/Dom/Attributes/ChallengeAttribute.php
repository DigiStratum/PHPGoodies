<?php
/**
 * PHPGoodies:ChallengeAttribute - CHALLENGE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * ChallengeAttribute - CHALLENGE element attribute trait for NodeElements to easily use
 */
trait ChallengeAttribute {
	/**
	 * Set the challenge attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setChallenge($value) {
		$this->setAttribute('challenge', $value);

		return $this;
	}

	/**
	 * Get the challenge attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getChallenge() {
		return $this->getAttribute('challenge');
	}
}

