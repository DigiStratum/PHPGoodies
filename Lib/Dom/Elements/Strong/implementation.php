<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Strong - STRONG Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Strong - STRONG Element
 */
class Lib_Dom_Elements_Strong extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('strong', 'block');
	}
}

