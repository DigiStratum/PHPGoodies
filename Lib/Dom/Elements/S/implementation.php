<?php
/**
  * PHPGoodies:Lib_Dom_Elements_S - S Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * S - S Element
 */
class Lib_Dom_Elements_S extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('s', 'block');
	}
}

