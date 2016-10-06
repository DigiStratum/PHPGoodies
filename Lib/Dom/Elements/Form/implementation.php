<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Form - FORM Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AcceptAttribute');
PHPGoodies::import('Lib.Dom.Attributes.AcceptCharSetAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ActionAttribute');
PHPGoodies::import('Lib.Dom.Attributes.AutoCapitalizeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.AutoCompleteAttribute');
PHPGoodies::import('Lib.Dom.Attributes.EncTypeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MethodAttribute');
PHPGoodies::import('Lib.Dom.Attributes.NameAttribute');
PHPGoodies::import('Lib.Dom.Attributes.NoValidateAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TargetAttribute');

/**
 * Form - FORM Element
 */
class Lib_Dom_Elements_Form extends Lib_Dom_Node_Element {
	use AcceptAttribute, AcceptCharSetAttribute, ActionAttribute, AutoCapitalizeAttribute;
	use AutoCompleteAttribute, EncTypeAttribute, MethodAttribute, NameAttribute;
	use NoValidateAttribute, TargetAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('form', 'block');
	}
}

