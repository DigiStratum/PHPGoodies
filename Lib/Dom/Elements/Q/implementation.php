<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Q - Q Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.CiteAttribute');

/**
 * Q - Q Element
 */
class Lib_Dom_Elements_Q extends Lib_Dom_Node_Element {
	use CiteAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('q', 'block');
	}
}

