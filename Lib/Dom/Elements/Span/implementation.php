<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Span - SPAN Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Span - SPAN Element
 */
class Lib_Dom_Elements_Span extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('span', 'block');
	}
}

