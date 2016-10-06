<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Dd - DD Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.NoWrapAttribute');


/**
 * Dd - DD Element
 */
class Lib_Dom_Elements_Dd extends Lib_Dom_Node_Element {
	use NoWrapAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('dd', 'block');
	}
}

