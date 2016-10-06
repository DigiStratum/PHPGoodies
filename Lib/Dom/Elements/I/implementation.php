<?php
/**
  * PHPGoodies:Lib_Dom_Elements_I - I Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * I - I Element
 */
class Lib_Dom_Elements_I extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('i', 'block');
	}
}

