<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Main - MAIN Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Main - MAIN Element
 */
class Lib_Dom_Elements_Main extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('main', 'block');
	}
}

