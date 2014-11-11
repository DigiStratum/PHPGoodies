<?php
/**
 * PHPGoodies:MozCurrentSampleOffsetAttribute - MOZCURRENTSAMPLEOFFSET element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * MozCurrentSampleOffsetAttribute - MOZCURRENTSAMPLEOFFSET element attribute trait for NodeElements to easily use
 */
trait MozCurrentSampleOffsetAttribute {
	/**
	 * Set the mozcurrentsampleoffset attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setMozCurrentSampleOffset($value) {
		$this->setAttribute('mozcurrentsampleoffset', $value);

		return $this;
	}

	/**
	 * Get the mozcurrentsampleoffset attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getMozCurrentSampleOffset() {
		return $this->getAttribute('mozcurrentsampleoffset');
	}
}

