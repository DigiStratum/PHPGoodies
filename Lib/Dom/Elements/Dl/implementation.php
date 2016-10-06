<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Dl - DL Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Dl - DL Element
 */
class Lib_Dom_Elements_Dl extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('dl', 'block');
	}
}

