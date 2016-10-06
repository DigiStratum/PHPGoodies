<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Sup - SUP Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Sup - SUP Element
 */
class Lib_Dom_Elements_Sup extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('sup', 'block');
	}
}

