<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Title - TITLE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Title - TITLE Element
 */
class Lib_Dom_Elements_Title extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('title', 'block');
	}
}

