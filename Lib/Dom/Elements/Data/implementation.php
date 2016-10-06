<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Value - VALUE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.ValueAttribute');

/**
 * Value - VALUE Element
 */
class Lib_Dom_Elements_Value extends Lib_Dom_Node_Element {
	use ValueAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('value', 'block');
	}
}

