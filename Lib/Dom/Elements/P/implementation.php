<?php
/**
  * PHPGoodies:Lib_Dom_Elements_P - P Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AlignAttribute');


/**
 * P - P Element
 */
class Lib_Dom_Elements_P extends Lib_Dom_Node_Element {
	use AlignAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('p', 'block');
	}
}

