<?php
/**
  * PHPGoodies:Lib_Dom_Elements_OptGroup - OPTGROUP Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.DisabledAttribute');
PHPGoodies::import('Lib.Dom.Attributes.LabelAttribute');

/**
 * OptGroup - OPTGROUP Element
 */
class Lib_Dom_Elements_OptGroup extends Lib_Dom_Node_Element {
	use DisabledAttribute, LabelAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('optgroup', 'block');
	}
}

