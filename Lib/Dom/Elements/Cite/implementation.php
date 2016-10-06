<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Cite - CITE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Cite - CITE Element
 */
class Lib_Dom_Elements_Cite extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('cite', 'block');
	}
}

