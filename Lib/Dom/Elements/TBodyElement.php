<?php
/**
  * PHPGoodies:TBodyElement - TBODY Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AlignAttribute');
PHPGoodies::import('Lib.Dom.Attributes.BgColorAttribute');
PHPGoodies::import('Lib.Dom.Attributes.CharAttribute');
PHPGoodies::import('Lib.Dom.Attributes.CharOffAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SpanAttribute');
PHPGoodies::import('Lib.Dom.Attributes.VAlignAttribute');

/**
 * TBodyElement - TBODY Element
 */
class TBodyElement extends NodeElement {
	use AlignAttribute, BgTBodyorAttribute, CharAttribute, CharOffAttribute, SpanAttribute;
	use VAlignAttribute, WidthAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('tbody', 'block');
	}
}

