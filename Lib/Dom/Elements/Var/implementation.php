<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Var - VAR Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Var - VAR Element
 */
class Lib_Dom_Elements_Var extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('var', 'block');
	}
}

