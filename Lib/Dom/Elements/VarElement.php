<?php
/**
  * PHPGoodies:VarElement - VAR Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * VarElement - VAR Element
 */
class VarElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('var', 'block');
	}
}

