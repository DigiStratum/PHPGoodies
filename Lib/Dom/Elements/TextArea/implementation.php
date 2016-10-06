<?php
/**
  * PHPGoodies:Lib_Dom_Elements_TextArea - TEXTAREA Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AutoCapitalizeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.AutoCompleteAttribute');
PHPGoodies::import('Lib.Dom.Attributes.AutoFocusAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ColsAttribute');
PHPGoodies::import('Lib.Dom.Attributes.DisabledAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FormAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MaxLengthAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MinLengthAttribute');
PHPGoodies::import('Lib.Dom.Attributes.NameAttribute');
PHPGoodies::import('Lib.Dom.Attributes.PlaceHolderAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ReadOnlyAttribute');
PHPGoodies::import('Lib.Dom.Attributes.RequiredAttribute');
PHPGoodies::import('Lib.Dom.Attributes.RowsAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SelectionDirectionAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SelectionEndAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SelectionStartAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SpellCheckAttribute');
PHPGoodies::import('Lib.Dom.Attributes.WrapAttribute');

/**
 * TextArea - TEXTAREA Element
 */
class Lib_Dom_Elements_TextArea extends Lib_Dom_Node_Element {
	use AutoCapitalizeAttribute, AutoCompleteAttribute, AutoFocusAttribute, ColsAttribute;
	use DisabledAttribute, FormAttribute, MaxLengthAttribute, MinLengthAttribute, NameAttribute;
	use PlaceHolderAttribute, ReadOnlyAttribute, RequiredAttribute, RowsAttribute;
	use SelectionDirectionAttribute, SelectionEndAttribute, SelectionStartAttribute;
	use SpellCheckAttribute, WrapAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('textarea', 'block');
	}
}

