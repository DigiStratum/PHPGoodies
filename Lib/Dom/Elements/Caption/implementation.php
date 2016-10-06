<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Caption - CAPTION Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AlignAttribute');

/**
 * Caption - CAPTION Element
 */
class Lib_Dom_Elements_Caption extends Lib_Dom_Node_Element {
	use AlignAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('caption', 'block');
	}
}

