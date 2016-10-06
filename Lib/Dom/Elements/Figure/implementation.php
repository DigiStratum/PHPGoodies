<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Figure - FIGURE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Figure - FIGURE Element
 */
class Lib_Dom_Elements_Figure extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('figure', 'block');
	}
}

