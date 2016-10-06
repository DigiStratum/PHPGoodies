<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Th - TH Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AbbrAttribute');
PHPGoodies::import('Lib.Dom.Attributes.AlignAttribute');
PHPGoodies::import('Lib.Dom.Attributes.AxisAttribute');
PHPGoodies::import('Lib.Dom.Attributes.BgColorAttribute');
PHPGoodies::import('Lib.Dom.Attributes.CharAttribute');
PHPGoodies::import('Lib.Dom.Attributes.CharOffAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ColSpanAttribute');
PHPGoodies::import('Lib.Dom.Attributes.HeadersAttribute');
PHPGoodies::import('Lib.Dom.Attributes.RowSpanAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ScopeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.VAlignAttribute');

/**
 * Th - TH Element
 */
class Lib_Dom_Elements_Th extends Lib_Dom_Node_Element {
	use AbbrAttribute, AlignAttribute, AxisAttribute, BgColorAttribute, CharAttribute;
	use CharOffAttribute, ColSpanAttribute, HeadersAttribute, RowSpanAttribute, ScopeAttribute;
	use VAlignAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('th', 'block');
	}
}

