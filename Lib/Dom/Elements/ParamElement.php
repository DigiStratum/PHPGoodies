<?php
/**
  * PHPGoodies:ParamElement - PARAM Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.NameAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TypeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ValueAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ValueTypeAttribute');

/**
 * ParamElement - PARAM Element
 */
class ParamElement extends NodeElement {
	use NameAttribute, TypeAttribute, ValueAttribute, ValueTypeAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('param', 'block');
	}
}

