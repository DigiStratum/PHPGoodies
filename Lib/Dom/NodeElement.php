<?php
/**
 * PHPGoodies:NodeElement - General HTML Element Generation support
 *
 * ref: https://developer.mozilla.org/en-US/docs/Web/Guide/HTML/HTML5/HTML5_element_list
 *
 * @todo Add support for restricting which element names/types are allowable children; use DTD?
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.Node');
PHPGoodies::import('Lib.Dom.NodeInterface');

// Attributes
PHPGoodies::import('Lib.Dom.NodeAttribute');
PHPGoodies::import('Lib.Dom.GlobalAttributes');

/**
 * NodeElement - General HTML Element Generation support
 */
class NodeElement extends Node implements NodeInterface {
	use GlobalAttributes;

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
	 * Set the named attribute on this element to the specified value
	 *
	 * @param string $name The name of the attribute to add
	 * @param string $value The value to assign to the attribute
	 *
	 * @return object $this for chaining...
	 */
	public function &setAttribute($name, $value = null) {

		// If this attribute is already set...
		$attrNode =& $this->getAttribute($name);
		if (isset($attrNode)) {

			// Update the value
			$attrNode->setValue($value);
		}
		else {

			// Make a new attribute!
			$attrNode = new NodeAttribute($name, $value);
			$this->appendNode($attrNode); 
		}
		return $this;
	}

	/**
	 * Get the named attribute if it is set
	 *
	 * @param string $name The name of the attribute we are after
	 *
	 * @return object NodeAttribute instance for the named attribute, or null if there isn't one
	 */
	public function &getAttribute($name) {
		foreach ($this->nodeList as $node) {
			if ($node->getType() != 'attribute') continue;
			if ($node->getName() == $name) return $node;
		}

		return null;
	}

	/**
	 * Remove the named attribute if it is set
	 *
	 * @param string $name The name of the attribute we are after
	 *
	 * @return object $this for chaining...
	 */
	public function &removeAttribute($name) {

		// My professors urged me never to use single-letter variable names, so...
		for ($xx = 0; $xx < count($this->nodeList); $xx++) {
			if ($this->nodeList[$xx]->getType() != 'attribute') continue;
			if ($this->nodeList[$xx]->getName() == $name) {

				// Get rid of this one...
				unset($this->nodeList[$xx]);

				// And reindex the array
				$this->nodeList = array_values($this->nodeList);

				break;
			}
		}

		return $this;
	}

	/**
	 * Add a child element to this one
	 *
	 * @param string $type The element type such as 'a', 'body', etc.
	 *
	 * @return object instance of the child class
	 */
	public function &addChild($type) {

		// Figure out the classname and import it as needed
		$className = ucfirst(strtolower($type)) . 'Element';
		if (! class_exists($className)) {
			PHPGoodies::import("Lib.Dom.Elements.{$className}");
		}
		$nsClassName = __NAMESPACE__ . "\\{$className}";
		return $this->appendNode(new $nsClassName());
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

