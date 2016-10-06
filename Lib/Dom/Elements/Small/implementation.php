<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Small - SMALL Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Small - SMALL Element
 */
class Lib_Dom_Elements_Small extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('small', 'block');
	}
}

