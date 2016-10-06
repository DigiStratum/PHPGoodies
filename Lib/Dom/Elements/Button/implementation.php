<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Button - BUTTON Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

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
 * Button - BUTTON Element
 */
class Lib_Dom_Elements_Button extends Lib_Dom_Node_Element {
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

