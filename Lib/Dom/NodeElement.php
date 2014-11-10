<?php
/**
 * PHPGoodies:NodeElement - General HTML Element Generation support
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.Node');
PHPGoodies::import('Lib.Dom.NodeInterface');
PHPGoodies::import('Lib.Dom.NodeAttribute');

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
	 * Set the named attribute on this element to the specified value
	 *
	 * @param string $name The name of the attribute to add
	 * @param string $value The value to assign to the attribute
	 *
	 * @return object $this for chaining...
	 */
	public function setAttribute($name, $value = null) {

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
	public function removeAttribute($name) {

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


	// HTML4 STANDARD ATTRIBUTES COMMON TO ALL ELEMENTS

	/**
	 * Set the accesskey attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setAccessKey($value = null) {
		$this->setAttribute('accesskey', $value);

		return $this;
	}

	/**
	 * Get the accesskey attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getAccessKey() {
		return $this->getAttribute('accesskey');
	}

	/**
	 * Set the class attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setClass($value) {
		$this->setAttribute('class', $value);

		return $this;
	}

	/**
	 * Get the class attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getClass() {
		return $this->getAttribute('class');
	}

	/**
	 * Set the dir attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setDir($value) {
		$this->setAttribute('dir', $value);

		return $this;
	}

	/**
	 * Get the dir attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getDir() {
		return $this->getAttribute('dir');
	}

	/**
	 * Set the id attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setId($value) {
		$this->setAttribute('id', $value);

		return $this;
	}

	/**
	 * Get the id attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getId() {
		return $this->getAttribute('id');
	}

	/**
	 * Set the lang attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setLang($value = null) {
		$this->setAttribute('lang', $value);

		return $this;
	}

	/**
	 * Get the lang attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getLang() {
		return $this->getAttribute('lang');
	}

	/**
	 * Set the style attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setStyle($value) {
		$this->setAttribute('style', $value);

		return $this;
	}

	/**
	 * Get the style attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getStyle() {
		return $this->getAttribute('style');
	}

	/**
	 *
	 * Set the tabindex attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setTabIndex($value) {
		$this->setAttribute('tabindex', $value);

		return $this;
	}

	/**
	 * Get the tabindex attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getTabIndex() {
		return $this->getAttribute('tabindex');
	}

	/**
	 * Set the title attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setTitle($value) {
		$this->setAttribute('title', $value);

		return $this;
	}

	/**
	 * Get the title attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getTitle() {
		return $this->getAttribute('title');
	}


	// HTML5 STANDARD ATTRIBUTES COMMON TO ALL ELEMENTS

	/**
	 * Set the contenteditable attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setContentEditable($value) {
		$this->setAttribute('contenteditable', $value);

		return $this;
	}

	/**
	 * Get the contenteditable attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getContentEditable() {
		return $this->getAttribute('contenteditable');
	}

	/**
	 * Set the contextmenu attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setContextMenu($value) {
		$this->setAttribute('contextmenu', $value);

		return $this;
	}

	/**
	 * Get the contextmenu attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getContextMenu() {
		return $this->getAttribute('contextmenu');
	}

	/**
	 * Set the draggable attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setDraggable($value) {
		$this->setAttribute('draggable', $value);

		return $this;
	}

	/**
	 * Get the draggable attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getDraggable() {
		return $this->getAttribute('draggable');
	}

	/**
	 * Set the dropzone attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setDropZone($value) {
		$this->setAttribute('dropzone', $value);

		return $this;
	}

	/**
	 * Get the dropzone attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getDropzone() {
		return $this->getAttribute('dropzone');
	}

	/**
	 * Set the hidden attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setHidden($value = null) {
		$this->setAttribute('hidden', $value);

		return $this;
	}

	/**
	 * Get the hidden attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getHidden() {
		return $this->getAttribute('hidden');
	}

	/**
	 * Set the spellcheck attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setSpellCheck($value = null) {
		$this->setAttribute('spellcheck', $value);

		return $this;
	}

	/**
	 * Get the spellcheck attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getSpellCheck() {
		return $this->getAttribute('spellcheck');
	}

	/**
	 * Set the translate attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setTranslate($value = null) {
		$this->setAttribute('translate', $value);

		return $this;
	}

	/**
	 * Get the translate attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getTranslate() {
		return $this->getAttribute('translate');
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

