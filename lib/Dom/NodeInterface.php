<?php
/**
 * PHPGoodies:NodeInterface - Interface that all DOM node types must implement
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * NodeInterface - Interface that all DOM node types must implement
 */
interface NodeInterface {

	/**
	 * Transform this node as it is currently defined into a string
	 *
	 * @return string A rendered string transformed from the properties of this node
	 */
	public function toString();
}

