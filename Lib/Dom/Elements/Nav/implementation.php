<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Nav - NAV Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Nav - NAV Element
 */
class Lib_Dom_Elements_Nav extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('nav', 'block');
	}
}

