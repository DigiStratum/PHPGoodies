<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Option - OPTION Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.DisabledAttribute');
PHPGoodies::import('Lib.Dom.Attributes.LabelAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SelectedAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ValueAttribute');

/**
 * Option - OPTION Element
 */
class Lib_Dom_Elements_Option extends Lib_Dom_Node_Element {
	use DisabledAttribute, LabelAttribute, SelectedAttribute, ValueAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('option', 'block');
	}
}

