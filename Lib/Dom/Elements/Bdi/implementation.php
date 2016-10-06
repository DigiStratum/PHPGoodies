<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Bdi - BDI Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Bdi - BDI Element
 */
class Lib_Dom_Elements_Bdi extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('bdi', 'block');
	}
}

