<?php
/**
 * PHPGoodies:Lib_Dom_Node_Text - General HTML Text Generation support
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node');
PHPGoodies::import('Lib.Dom.Node.Interface');

/**
 * NodeText - General HTML Text Generation support
 */
class Lib_Dom_Node_Text extends Lib_Dom_Node implements Lib_Dom_Node_Interface {

	/**
	 * Constructor
	 *
	 * @param string $value The value to set this text node to
	 */
	public function __construct($value) {
		parent::__construct('text');
		$this->value = $value;
	}

	/**
	 * Turn this text node into a string
	 *
	 * @return string The rendered text... is itself. Yay!
	 */
	public function toString() {
		return $this->value;
	}
}

