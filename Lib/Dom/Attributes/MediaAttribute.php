<?php
/**
 * PHPGoodies:MediaAttribute - MEDIA element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * MediaAttribute - MEDIA element attribute trait for NodeElements to easily use
 */
trait MediaAttribute {
	/**
	 * Set the media attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setMedia($value) {
		$this->setAttribute('media', $value);

		return $this;
	}

	/**
	 * Get the media attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getMedia() {
		return $this->getAttribute('media');
	}
}

