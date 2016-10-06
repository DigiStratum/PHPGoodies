<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Track - TRACK Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.DefaultAttribute');
PHPGoodies::import('Lib.Dom.Attributes.KindAttribute');
PHPGoodies::import('Lib.Dom.Attributes.LabelAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SrcAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SrcLangAttribute');

/**
 * Track - TRACK Element
 */
class Lib_Dom_Elements_Track extends Lib_Dom_Node_Element {
	use DefaultAttribute, KindAttribute, LabelAttribute, SrcAttribute, SrcLangAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('track', 'block');
	}
}

