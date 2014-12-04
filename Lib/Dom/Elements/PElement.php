<?php
/**
  * PHPGoodies:PElement - P Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AlignAttribute');


/**
 * PElement - P Element
 */
class PElement extends NodeElement {
	use AlignAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('p', 'block');
	}
}

