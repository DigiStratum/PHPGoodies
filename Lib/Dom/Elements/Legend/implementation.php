<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Legend - LEGEND Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Legend - LEGEND Element
 */
class Lib_Dom_Elements_Legend extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('legend', 'block');
	}
}

