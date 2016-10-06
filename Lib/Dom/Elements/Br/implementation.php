<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Br - BR Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.ClearAttribute');

/**
 * Br - BR Element
 */
class Lib_Dom_Elements_Br extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('br', 'block');
	}
}

