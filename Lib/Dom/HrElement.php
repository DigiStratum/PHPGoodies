<?php
/**
  * PHPGoodies:HrElement - HR Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.AlignAttribute');
PHPGoodies::import('Lib.Dom.ColorAttribute');
PHPGoodies::import('Lib.Dom.NoShadeAttribute');
PHPGoodies::import('Lib.Dom.SizeAttribute');
PHPGoodies::import('Lib.Dom.WidthAttribute');

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

