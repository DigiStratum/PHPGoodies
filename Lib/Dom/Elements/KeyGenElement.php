<?php
/**
  * PHPGoodies:KeyGenElement - KEYGEN Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AutoFocusAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ChallengeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.DisabledAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FormAttribute');
PHPGoodies::import('Lib.Dom.Attributes.KeyTypeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.NameAttribute');

/**
 * KeyGenElement - KEYGEN Element
 */
class KeyGenElement extends NodeElement {
	use AutoFocusAttribute, ChallengeAttribute, DisabledAttribute, FormAttribute;
	use KeyTypeAttribute, NameAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('keygen', 'block');
	}
}

