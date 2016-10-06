<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_CrossOrigin - CROSSORIGIN element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * CrossOrigin - CROSSORIGIN element attribute trait for NodeElements to easily use
 */
trait Lib_Dom_Attributes_CrossOrigin {
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

