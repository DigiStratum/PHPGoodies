<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Param - PARAM Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.NameAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TypeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ValueAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ValueTypeAttribute');

/**
 * Param - PARAM Element
 */
class Lib_Dom_Elements_Param extends Lib_Dom_Node_Element {
	use NameAttribute, TypeAttribute, ValueAttribute, ValueTypeAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('param', 'block');
	}
}

