<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Ol - OL Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.CompactAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ReversedAttribute');
PHPGoodies::import('Lib.Dom.Attributes.StartAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TypeAttribute');

/**
 * Ol - OL Element
 */
class Lib_Dom_Elements_Ol extends Lib_Dom_Node_Element {
	use CompactAttribute, ReversedAttribute, StartAttribute, TypeAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('ol', 'block');
	}
}

