<?php
/**
  * PHPGoodies:Lib_Dom_Elements_KeyGen - KEYGEN Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AutoFocusAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ChallengeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.DisabledAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FormAttribute');
PHPGoodies::import('Lib.Dom.Attributes.KeyTypeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.NameAttribute');

/**
 * KeyGen - KEYGEN Element
 */
class Lib_Dom_Elements_KeyGen extends Lib_Dom_Node_Element {
	use AutoFocusAttribute, ChallengeAttribute, DisabledAttribute, FormAttribute;
	use KeyTypeAttribute, NameAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('keygen', 'block');
	}
}

