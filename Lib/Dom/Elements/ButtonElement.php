<?php
/**
  * PHPGoodies:ButtonElement - BUTTON Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AutoCompleteAttribute');
PHPGoodies::import('Lib.Dom.Attributes.DisabledAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FormAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FormActionAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FormEncTypeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FormMethodAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FormNoValidateAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FormTargetAttribute');
PHPGoodies::import('Lib.Dom.Attributes.NameAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TypeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ValueAttribute');

/**
 * ButtonElement - BUTTON Element
 */
class ButtonElement extends NodeElement {
	use AutoFocusAttribute, AutoCompleteAttribute, DisabledAttribute, FormAttribute;
	use FormActionAttribute, FormEncTypeAttribute, FormMethodAttribute, FormNoValidateAttribute;
	use FormTargetAttribute, NameAttribute, TypeAttribute, ValueAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('button', 'block');
	}
}

