<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Header - HEADER Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Header - HEADER Element
 */
class Lib_Dom_Elements_Header extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('header', 'block');
	}
}

