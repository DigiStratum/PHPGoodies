<?php
/**
 * PHPGoodies:XMozErrorMessageAttribute - X-MOZ-ERRORMESSAGE element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * XMozErrorMessageAttribute - X-MOZ-ERRORMESSAGE element attribute trait for NodeElements to easily use
 */
trait XMozErrorMessageAttribute {
	/**
	 * Set the x-moz-errormessage attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setXMozErrorMessage($value) {
		$this->setAttribute('x-moz-errormessage', $value);

		return $this;
	}

	/**
	 * Get the x-moz-errormessage attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getXMozErrorMessage() {
		return $this->getAttribute('x-moz-errormessage');
	}
}

