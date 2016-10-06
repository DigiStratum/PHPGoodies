<?php
/**
  * PHPGoodies:Lib_Dom_Elements_H2 - H2 Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AlignAttribute');


/**
 * H2 - H2 Element
 */
class Lib_Dom_Elements_H2 extends Lib_Dom_Node_Element {
	use AlignAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('h2', 'block');
	}
}

