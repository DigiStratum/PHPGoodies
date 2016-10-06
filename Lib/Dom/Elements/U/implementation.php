<?php
/**
  * PHPGoodies:Lib_Dom_Elements_U - U Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * U - U Element
 */
class Lib_Dom_Elements_U extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('u', 'block');
	}
}

