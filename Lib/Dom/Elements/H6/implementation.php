<?php
/**
  * PHPGoodies:Lib_Dom_Elements_H6 - H6 Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AlignAttribute');


/**
 * H6 - H6 Element
 */
class Lib_Dom_Elements_H6 extends Lib_Dom_Node_Element {
	use AlignAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('h6', 'block');
	}
}
