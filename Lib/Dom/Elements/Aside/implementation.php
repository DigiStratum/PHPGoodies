<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Aside - ASIDE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Aside - ASIDE Element
 */
class Lib_Dom_Elements_Aside extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('aside', 'block');
	}
}

