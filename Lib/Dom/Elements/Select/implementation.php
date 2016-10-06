<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Select - SELECT Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AutoFocusAttribute');
PHPGoodies::import('Lib.Dom.Attributes.DisabledAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FormAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MultipleAttribute');
PHPGoodies::import('Lib.Dom.Attributes.NameAttribute');
PHPGoodies::import('Lib.Dom.Attributes.RequiredAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SizeAttribute');

/**
 * Select - SELECT Element
 */
class Lib_Dom_Elements_Select extends Lib_Dom_Node_Element {
	use AutoFocusAttribute, DisabledAttribute, FormAttribute, MultipleAttribute, NameAttribute;
	use RequiredAttribute, SizeAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('select', 'block');
	}
}

