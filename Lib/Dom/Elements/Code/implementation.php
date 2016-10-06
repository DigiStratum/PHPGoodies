<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Code - CODE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Code - CODE Element
 */
class Lib_Dom_Elements_Code extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('code', 'block');
	}
}

