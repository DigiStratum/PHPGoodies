<?php
/**
  * PHPGoodies:TFootElement - TFOOT Element
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
 * TFootElement - TFOOT Element
 */
class TFootElement extends NodeElement {
	use AlignAttribute, BgTFootorAttribute, CharAttribute, CharOffAttribute, SpanAttribute;
	use VAlignAttribute, WidthAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('tfoot', 'block');
	}
}

