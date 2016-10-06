<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Section - SECTION Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Section - SECTION Element
 */
class Lib_Dom_Elements_Section extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('section', 'block');
	}
}

