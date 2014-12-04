<?php
/**
  * PHPGoodies:KbdElement - KBD Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * KbdElement - KBD Element
 */
class KbdElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('kbd', 'block');
	}
}

