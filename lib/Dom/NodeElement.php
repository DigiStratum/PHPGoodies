<?php
/**
 * PHPGoodies:NodeElement - General HTML Element Generation support
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

PHPGoodies::import('lib.Dom.Node');
PHPGoodies::import('lib.Dom.NodeInterface');
PHPGoodies::import('lib.Dom.NodeAttribute');

/**
 * NodeElement - General HTML Element Generation support
 */
class NodeElement extends Node implements NodeInterface {

	/**
	 * Type of the element ('inline' or 'block')
	 */
	protected $elementType;

	/**
	 * Constructor
	 *
	 * @param string $name The kind of Html element (i.e. 'a', 'table', etc.)
	 * @param string $elementType The type of element (either 'inline' or 'block')
	 */
	public function __construct($name, $elementType) {
		parent::__construct('element');
		$this->name = $name;
		$this->elementType = $elementType;
	}

	/**
	 * Add an attribute to this element with the specified name/value
	 *
	 * Note that no effort is made to prevent the addition of the same attribute twice.
	 *
	 * @param string $name The name of the attribute to add
	 * @param string $value The value to assign to the attribute
	 *
	 * @return object $this for chaining...
	 */
	public function addAttribute($name, $value = null) {
		$attrNode = new NodeAttribute($name, $value);
		$this->appendNode($attrNode); 
		return $this;
	}

	/**
	 * Turn this element node into a string
	 *
	 * @return string HTML with the rendered element
	 */
	public function toString() {

		// No matter which element type, it could have attributes
		$attributes = $this->nodeListToString(array('attribute'));

		switch ($this->elementType) {
			case 'block':
				// Block types can have other nodes/elements inside of them
				$children = $this->nodeListToString(array('element','text','comment'));
				return "<{$this->name}{$attributes}>{$children}</{$this->name}>";

			case 'inline':
				return "<{$this->name}{$attributes}/>";

			default:
				throw new Exception("Invalid element type '{$this->elementType}'");
		}
	}
}
