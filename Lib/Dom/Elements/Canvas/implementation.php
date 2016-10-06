<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Canvas - CANVAS Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.HeightAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MozOpaqueAttribute');
PHPGoodies::import('Lib.Dom.Attributes.WidthAttribute');

/**
 * Canvas - CANVAS Element
 */
class Lib_Dom_Elements_Canvas extends Lib_Dom_Node_Element {
	use HeightAttribute, MozOpaqueAttribute, WidthAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('canvas', 'block');
	}
}

