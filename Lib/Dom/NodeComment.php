<?php
/**
 * PHPGoodies:NodeComment - General HTML Comment Generation support
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node');
PHPGoodies::import('Lib.Dom.NodeInterface');

/**
 * NodeComment - General HTML Comment Generation support
 */
class NodeComment extends Node implements NodeInterface {

	/**
	 * Constructor
	 *
	 * @param string $value The value to set this comment's text node to
	 */
	public function __construct($value) {
		parent::__construct('comment');
		$this->value = $value;
	}

	/**
	 * Turn this comment node into a string
	 *
	 * @return string The rendered comment string
	 */
	public function toString() {
		return "<!-- {$this->value} -->";
	}
}