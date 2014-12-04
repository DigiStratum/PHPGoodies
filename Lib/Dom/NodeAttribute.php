<?php
/**
 * PHPGoodies:NodeAttribute - General HTML Attribute Generation support
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node');
PHPGoodies::import('Lib.Dom.NodeInterface');

/**
 * If someone asks us what our value is and it is null (unset), then...
 */
define('UNDEFINED', 0);

/**
 * NodeAttribute - General HTML Attribute Generation support
 */
class NodeAttribute extends Node implements NodeInterface {

	/**
	 * Constructor
	 *
	 * @param string $name The kind of Html element attribute (i.e. 'id', 'name', etc.)
	 * @param string $value The value to set this attribute to (optional)
	 */
	public function __construct($name, $value = null) {
		parent::__construct('attribute');
		$this->name = $name;
		$this->setValue($value);
	}

	/**
	 * Set our value to whatever is supplied 
	 *
	 * Although if what is supplied is NULL, then we'll set to UNDEFINED
	 *
	 * @param string $value Value to be set, or null if unset
	 *
	 * @return object This object for chaining...
	 */
	public function setValue($value = null) {

		// Set value as a string if it is supplied so that strings are valid values,
		// and numbers are status codes that we use internally for errors and such
		$this->value = isset($value) ? (string) $value : UNDEFINED;

		return $this;
	}

	/**
	 * Turn this attribute node into a string
	 *
	 * @return string HTML with the rendered attribute
	 */
	public function toString() {
		return " {$this->name}" . (is_null($this->value) ? '' : "=\"{$this->value}\"");
	}
}
