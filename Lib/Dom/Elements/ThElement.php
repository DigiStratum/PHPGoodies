<?php
/**
  * PHPGoodies:ThElement - TH Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

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
 * ThElement - TH Element
 */
class ThElement extends NodeElement {
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

