<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Ins - INS Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.CiteAttribute');
PHPGoodies::import('Lib.Dom.Attributes.DateTimeAttribute');

/**
 * Ins - INS Element
 */
class Lib_Dom_Elements_Ins extends Lib_Dom_Node_Element {
	use CiteAttribute, DateTimeAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('ins', 'block');
	}
}

