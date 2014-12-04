<?php
/**
  * PHPGoodies:DivElement - DIV Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AlignAttribute');


/**
 * DivElement - DIV Element
 */
class DivElement extends NodeElement {
	use AlignAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('div', 'block');
	}
}

