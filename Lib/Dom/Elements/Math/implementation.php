<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Math - MATH Element
  *
  * @todo Add support for MathML child elements
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.DirAttribute');
PHPGoodies::import('Lib.Dom.Attributes.HrefAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MathBackgroundAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MathColorAttribute');
PHPGoodies::import('Lib.Dom.Attributes.DisplayAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ModeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.OverflowAttribute');

/**
 * Math - MATH Element
 */
class Lib_Dom_Elements_Math extends Lib_Dom_Node_Element {
	 use DirAttribute, HrefAttribute, MathBackgroundAttribute, MathColorAttribute;
	use DisplayAttribute, ModeAttribute, OverflowAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('math', 'block');
	}
}

