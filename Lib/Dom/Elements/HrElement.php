<?php
/**
  * PHPGoodies:HrElement - HR Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AlignAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ColorAttribute');
PHPGoodies::import('Lib.Dom.Attributes.NoShadeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SizeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.WidthAttribute');

/**
 * HrElement - HR Element
 */
class HrElement extends NodeElement {
	use AlignAttribute, ColorAttribute, NoShadeAttribute, SizeAttribute, WidthAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('hr', 'inline');
	}
}

