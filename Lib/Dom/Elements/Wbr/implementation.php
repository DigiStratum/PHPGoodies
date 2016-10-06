<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Wbr - WBR Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Wbr - WBR Element
 */
class Lib_Dom_Elements_Wbr extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('wbr', 'block');
	}
}

