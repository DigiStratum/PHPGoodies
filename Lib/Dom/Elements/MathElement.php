<?php
/**
  * PHPGoodies:MathElement - MATH Element
  *
  * @todo Add support for MathML child elements
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.DirAttribute');
PHPGoodies::import('Lib.Dom.Attributes.HrefAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MathBackgroundAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MathColorAttribute');
PHPGoodies::import('Lib.Dom.Attributes.DisplayAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ModeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.OverflowAttribute');

/**
 * MathElement - MATH Element
 */
class MathElement extends NodeElement {
	 use DirAttribute, HrefAttribute, MathBackgroundAttribute, MathColorAttribute;
	use DisplayAttribute, ModeAttribute, OverflowAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('math', 'block');
	}
}

