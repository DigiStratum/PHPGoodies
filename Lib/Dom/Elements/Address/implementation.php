<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Address - ADDRESS Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Address - ADDRESS Element
 */
class Lib_Dom_Elements_Address extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('address', 'block');
	}
}

