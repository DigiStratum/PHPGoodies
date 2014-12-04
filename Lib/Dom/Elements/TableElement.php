<?php
/**
  * PHPGoodies:TableElement - TABLE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

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
 * TableElement - TABLE Element
 */
class TableElement extends NodeElement {
	use AlignAttribute, BgColorAttribute, BorderAttribute, CellPaddingAttribute;
	use CellSpacingAttribute, FrameAttribute, RulesAttribute, SummaryAttribute, WidthAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('table', 'block');
	}
}

