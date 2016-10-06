<?php
/**
 * PHPGoodies:Node - A DOM node
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Node - A DOM node
 *
 * This serves as the base class functionality for all the node types. Note that the set of nodes of
 * type='attribute' that are in the set of nodeList are our attributes, but the set of nodes of
 * types 'element', 'text', and 'comment' are nested below this one.
 *
 * ref: http://www.w3schools.com/jsref/dom_obj_all.asp
 */
abstract class Node {

	/**
	 * The type of this node
	 */
	protected $type;

	/**
	 * The name of this node
	 *
	 * Used for the name of a element/attribute nodes. Note that we can still have a child node
	 * attribute whose name is 'name' which is different from this being the name of the element
	 * or attribute node itself.
	 */
	protected $name = null;

	/**
	 * The value of this node
	 *
	 * Used for the text body of text/comment/atribute type nodes.
	 */
	protected $value = null;

	/**
	 * Child nodes
	 */
	protected $nodeList = array();

	/**
	 * Constructor
	 *
	 * @param string $type The type of node ('element', 'attribute', 'text', or 'comment')
	 */
	public function __construct($type) {
		$this->type = $type;
	}

	/**
	 * Getter for our type
	 *
	 * @return string The type of this node
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Getter for our name
	 *
	 * @return string The name of this node
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Getter for our value
	 *
	 * @return string The value of this node
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * Append a child node to the end of the set of nodeList for this node
	 *
	 * @param object $node A Node opject to append to our set of nodeList
	 *
	 * @return object Reference to the newly appended node
	 */
	public function &appendNode($node) {

		// Only other Nodes need apply...
		if (! ($node instanceof Node)) return;
		$this->nodeList[] = $node;

		return $this->nodeList[count($this->nodeList) - 1];
	}

	/**
	 * Prepend a child node to the beginning of the set of nodeList for this node
	 *
	 * @param object $node A Node opject to prepend to our set of nodeList
	 *
	 * @return object Reference to the newly appended node
	 */
	public function &prependNode($node) {

		// Only other Nodes need apply...
		if (! ($node instanceof Node)) return;
		array_unshift($this->nodeList, $node);

		return $this->nodeList[0];
	}

	/**
	 * Flatten the entire nodeList out into a string
	 *
	 * Note only node types in the array will be converted, others will be sckipped.
	 *
	 * @param array $types A list of types that we want to convert
	 *
	 * @return string A flattened string with the the nodeList converted, in sequence.
	 */
	public function nodeListToString($types) {
		$output = '';
                foreach ($this->nodeList as $node) {
                        if (in_array($node->type, $types)) {
                                $output .= $node->toString();
                        }
                }

		return $output;
	}
}

