<?php
/**
 * PHPGoodies:SpanAttribute - SPAN element attribute trait for NodeElements to easily use
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/**
 * SpanAttribute - SPAN element attribute trait for NodeElements to easily use
 */
trait SpanAttribute {
	/**
	 * Set the span attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setSpan($value) {
		$this->setAttribute('span', $value);

		return $this;
	}

	/**
	 * Get the span attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getSpan() {
		return $this->getAttribute('span');
	}
}

