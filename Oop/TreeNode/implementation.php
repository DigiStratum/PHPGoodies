<?php
/**
 * PHPGoodies:Oop_TreeNode - An abstract Tree Node class to extend with the properties you need
 *
 * This kind of tree allows each node to have multiple children, but only one parent. The children
 * are ordered, so that the tree can be traversed in a predictable manner.
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * TreeNode - An abstract Tree Node class to extend with the properties you need
 */
abstract class Oop_TreeNode {

	/**
	 * The class that extends us
	 */
	protected $classname = '';

	/**
	 * Our ordered set of child tree nodes
	 */
	protected $children = array();

	/**
	 * Our parent tree node
	 */
	protected $parent = null;

	/**
	 * Constructor
	 *
	 * @param string $classname The name of the class that extends us
	 */
	protected function __construct($classname) {
		$this->classname = $classname;
	}

	/**
	 * Check that the supplied object instance matches our classname
	 *
	 * Note that if get_class() ends up not being adequate, just override this method in your
	 * class with logic apprpriate to your needs, or have it do nothign at all to allow anything.
	 *
	 * @param object $instance An object instance that we want to link in
	 */
	protected function checkInstance(&$instance) {
		if (get_class($instance) != $this->classname) {
			throw new Exception("Wrong class; ecpected '{$this->classname}', but got '" . get_class($instance) . "'");
		}
	}

	/**
	 * Link in the supplied object instance as a new child
	 *
	 * @param object $instance An object instance that we want to link in
	 *
	 * @return object $this for chaining...
	 */
	protected function addChild(&$instance) {
		$this->checkInstance($instance);
		$this->children[] = $instance;
		return $this;
	}

	/**
	 * Link in the supplied object instance as our parent
	 *
	 * @param object $instance An object instance that we want to link in
	 *
	 * @return object $this for chaining...
	 */
	protected function setParent(&$instance) {
		$this->checkInstance($instance);
		$this->parent = $instance;
		return $this;
	}
}

