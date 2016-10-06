<?php
/**
  * PHPGoodies:Lib_Dom_Elements_B - B Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * B - B Element
 */
class Lib_Dom_Elements_B extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('b', 'block');
	}
}

