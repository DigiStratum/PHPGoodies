<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Ul - UL Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.CompactAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TypeAttribute');

/**
 * Ul - UL Element
 */
class Lib_Dom_Elements_Ul extends Lib_Dom_Node_Element {
	use CompactAttribute, TypeAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('ul', 'block');
	}
}

