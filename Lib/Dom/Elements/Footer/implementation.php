<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Footer - FOOTER Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Footer - FOOTER Element
 */
class Lib_Dom_Elements_Footer extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('footer', 'block');
	}
}

