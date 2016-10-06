<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Dfn - DFN Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Dfn - DFN Element
 */
class Lib_Dom_Elements_Dfn extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('dfn', 'block');
	}
}

