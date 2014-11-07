<?php
/**
 * PHPGoodies:NodeAttribute - General HTML Attribute Generation support
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.Node');
PHPGoodies::import('Lib.Dom.NodeInterface');

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
		$this->value = $value;
	}

	/**
	 * Turn this attribute node into a string
	 *
	 * @return string HTML with the rendered attribute
	 */
	public function toString() {
		return " {$this->name}" . (is_null($this->value) ? '' : "\"{$this->value}\"");
	}
}
