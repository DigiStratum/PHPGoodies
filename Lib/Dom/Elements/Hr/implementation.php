<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Hr - HR Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AlignAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ColorAttribute');
PHPGoodies::import('Lib.Dom.Attributes.NoShadeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SizeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.WidthAttribute');

/**
 * Hr - HR Element
 */
class Lib_Dom_Elements_Hr extends Lib_Dom_Node_Element {
	use AlignAttribute, ColorAttribute, NoShadeAttribute, SizeAttribute, WidthAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('hr', 'inline');
	}
}

