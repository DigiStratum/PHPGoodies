<?php
/**
  * PHPGoodies:H4Element - H4 Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AlignAttribute');


/**
 * H4Element - H4 Element
 */
class H4Element extends NodeElement {
	use AlignAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('h4', 'block');
	}
}

