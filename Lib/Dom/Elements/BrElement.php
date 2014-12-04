<?php
/**
  * PHPGoodies:BrElement - BR Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.ClearAttribute');

/**
 * BrElement - BR Element
 */
class BrElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('br', 'block');
	}
}

