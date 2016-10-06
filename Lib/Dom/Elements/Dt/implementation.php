<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Dt - DT Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Dt - DT Element
 */
class Lib_Dom_Elements_Dt extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('dt', 'block');
	}
}

