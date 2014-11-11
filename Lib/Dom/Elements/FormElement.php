<?php
/**
  * PHPGoodies:FormElement - FORM Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

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
 * FormElement - FORM Element
 */
class FormElement extends NodeElement {
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

