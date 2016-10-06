<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Sub - SUB Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Sub - SUB Element
 */
class Lib_Dom_Elements_Sub extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('sub', 'block');
	}
}

