<?php
/**
 * PHPGoodies:CrossOriginAttribute - CROSSORIGIN element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * CrossOriginAttribute - CROSSORIGIN element attribute trait for NodeElements to easily use
 */
trait CrossOriginAttribute {
	/**
	 * Set the crossorigin attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setCrossOrigin($value) {
		$this->setAttribute('crossorigin', $value);

		return $this;
	}

	/**
	 * Get the crossorigin attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getCrossOrigin() {
		return $this->getAttribute('crossorigin');
	}
}

