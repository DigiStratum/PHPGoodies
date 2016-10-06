<?php
/**
 * PHPGoodies:Lib_Dom_Node_Comment - General HTML Comment Generation support
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node');
PHPGoodies::import('Lib.Dom.Node.Interface');

/**
 * NodeComment - General HTML Comment Generation support
 */
class Lib_Dom_Node_Comment extends Lib_Dom_Node implements Lib_Dom_Node_Interface {

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
