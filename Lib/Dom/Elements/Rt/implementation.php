<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Rt - RT Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Rt - RT Element
 */
class Lib_Dom_Elements_Rt extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('rt', 'block');
	}
}

