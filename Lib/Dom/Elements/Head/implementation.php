<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Head - HEAD Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.ProfileAttribute');


/**
 * Head - HEAD Element
 */
class Lib_Dom_Elements_Head extends Lib_Dom_Node_Element {
	use ProfileAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('head', 'block');
	}
}

