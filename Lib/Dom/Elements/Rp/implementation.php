<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Rp - RP Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Rp - RP Element
 */
class Lib_Dom_Elements_Rp extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('rp', 'block');
	}
}

