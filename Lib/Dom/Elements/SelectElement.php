<?php
/**
  * PHPGoodies:SelectElement - SELECT Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AutoFocusAttribute');
PHPGoodies::import('Lib.Dom.Attributes.DisabledAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FormAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MultipleAttribute');
PHPGoodies::import('Lib.Dom.Attributes.NameAttribute');
PHPGoodies::import('Lib.Dom.Attributes.RequiredAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SizeAttribute');

/**
 * SelectElement - SELECT Element
 */
class SelectElement extends NodeElement {
	use AutoFocusAttribute, DisabledAttribute, FormAttribute, MultipleAttribute, NameAttribute;
	use RequiredAttribute, SizeAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('select', 'block');
	}
}

