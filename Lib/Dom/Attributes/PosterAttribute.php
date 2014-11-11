<?php
/**
 * PHPGoodies:PosterAttribute - POSTER element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * PosterAttribute - POSTER element attribute trait for NodeElements to easily use
 */
trait PosterAttribute {
	/**
	 * Set the poster attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setPoster($value) {
		$this->setAttribute('poster', $value);

		return $this;
	}

	/**
	 * Get the poster attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getPoster() {
		return $this->getAttribute('poster');
	}
}

