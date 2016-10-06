<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Table - TABLE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AlignAttribute');
PHPGoodies::import('Lib.Dom.Attributes.BgColorAttribute');
PHPGoodies::import('Lib.Dom.Attributes.BorderAttribute');
PHPGoodies::import('Lib.Dom.Attributes.CellPaddingAttribute');
PHPGoodies::import('Lib.Dom.Attributes.CellSpacingAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FrameAttribute');
PHPGoodies::import('Lib.Dom.Attributes.RulesAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SummaryAttribute');
PHPGoodies::import('Lib.Dom.Attributes.WidthAttribute');

/**
 * Table - TABLE Element
 */
class Lib_Dom_Elements_Table extends Lib_Dom_Node_Element {
	use AlignAttribute, BgColorAttribute, BorderAttribute, CellPaddingAttribute;
	use CellSpacingAttribute, FrameAttribute, RulesAttribute, SummaryAttribute, WidthAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('table', 'block');
	}
}

