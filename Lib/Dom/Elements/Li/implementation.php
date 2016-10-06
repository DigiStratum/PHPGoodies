<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Li - LI Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.ValueAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TypeAttribute');

/**
 * Li - LI Element
 */
class Lib_Dom_Elements_Li extends Lib_Dom_Node_Element {
	use ValueAttribute, TypeAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('li', 'block');
	}
}

