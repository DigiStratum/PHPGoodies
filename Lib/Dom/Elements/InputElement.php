<?php
/**
  * PHPGoodies:InputElement - INPUT Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.TypeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.AcceptAttribute');
PHPGoodies::import('Lib.Dom.Attributes.AccessKeyAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MozActionHintAttribute');
PHPGoodies::import('Lib.Dom.Attributes.AutoCapitalizeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.AutoCompleteAttribute');
PHPGoodies::import('Lib.Dom.Attributes.AutoCorrectAttribute');
PHPGoodies::import('Lib.Dom.Attributes.AutoFocusAttribute');
PHPGoodies::import('Lib.Dom.Attributes.AutoSaveAttribute');
PHPGoodies::import('Lib.Dom.Attributes.CheckedAttribute');
PHPGoodies::import('Lib.Dom.Attributes.DisabledAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FormAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FormActionAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FormEncTypeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FormMethodAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FormNoValidateAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FormTargetAttribute');
PHPGoodies::import('Lib.Dom.Attributes.HeightAttribute');
PHPGoodies::import('Lib.Dom.Attributes.IncrementalAttribute');
PHPGoodies::import('Lib.Dom.Attributes.InputModeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ListAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MaxAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MaxLengthAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MinAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MinLengthAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MultipleAttribute');
PHPGoodies::import('Lib.Dom.Attributes.NameAttribute');
PHPGoodies::import('Lib.Dom.Attributes.PatternAttribute');
PHPGoodies::import('Lib.Dom.Attributes.PlaceHolderAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ReadOnlyAttribute');
PHPGoodies::import('Lib.Dom.Attributes.RequiredAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SelectionDirectionAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SizeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SpellCheckAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SrcAttribute');
PHPGoodies::import('Lib.Dom.Attributes.StepAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TabIndexAttribute');
PHPGoodies::import('Lib.Dom.Attributes.UseMapAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ValueAttribute');
PHPGoodies::import('Lib.Dom.Attributes.WidthAttribute');
PHPGoodies::import('Lib.Dom.Attributes.XMozErrorMessageAttribute');

/**
 * InputElement - INPUT Element
 */
class InputElement extends NodeElement {
	use TypeAttribute, AcceptAttribute, AccessKeyAttribute, MozActionHintAttribute;
	use AutoCapitalizeAttribute, AutoCompleteAttribute, AutoCorrectAttribute;
	use AutoFocusAttribute, AutoSaveAttribute, CheckedAttribute, DisabledAttribute;
	use FormAttribute, FormActionAttribute, FormEncTypeAttribute, FormMethodAttribute;
	use FormNoValidateAttribute, FormTargetAttribute, HeightAttribute, IncrementalAttribute;
	use InputModeAttribute, ListAttribute, MaxAttribute, MaxLengthAttribute, MinAttribute;
	use MinLengthAttribute, MultipleAttribute, NameAttribute, PatternAttribute;
	use PlaceHolderAttribute, ReadOnlyAttribute, RequiredAttribute, SelectionDirectionAttribute;
	use SizeAttribute, SpellCheckAttribute, SrcAttribute, StepAttribute, TabIndexAttribute;
	use UseMapAttribute, ValueAttribute, WidthAttribute, XMozErrorMessageAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('input', 'block');
	}
}

