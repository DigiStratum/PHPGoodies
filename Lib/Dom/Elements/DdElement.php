<?php
/**
  * PHPGoodies:DdElement - DD Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.NoWrapAttribute');


/**
 * DdElement - DD Element
 */
class DdElement extends NodeElement {
	use NoWrapAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('dd', 'block');
	}
}

