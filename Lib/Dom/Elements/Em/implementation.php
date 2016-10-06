<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Em - EM Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Em - EM Element
 */
class Lib_Dom_Elements_Em extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('em', 'block');
	}
}

