<?php
/**
  * PHPGoodies:THeadElement - THEAD Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AlignAttribute');
PHPGoodies::import('Lib.Dom.Attributes.BgColorAttribute');
PHPGoodies::import('Lib.Dom.Attributes.CharAttribute');
PHPGoodies::import('Lib.Dom.Attributes.CharOffAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SpanAttribute');
PHPGoodies::import('Lib.Dom.Attributes.VAlignAttribute');

/**
 * THeadElement - THEAD Element
 */
class THeadElement extends NodeElement {
	use AlignAttribute, BgTHeadorAttribute, CharAttribute, CharOffAttribute, SpanAttribute;
	use VAlignAttribute, WidthAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('thead', 'block');
	}
}

