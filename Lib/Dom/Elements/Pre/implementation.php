<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Pre - PRE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.ColsAttribute');
PHPGoodies::import('Lib.Dom.Attributes.WidthAttribute');
PHPGoodies::import('Lib.Dom.Attributes.WrapAttribute');

/**
 * Pre - PRE Element
 */
class Lib_Dom_Elements_Pre extends Lib_Dom_Node_Element {
	use ColsAttribute, WidthAttribute, WrapAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('pre', 'block');
	}
}

