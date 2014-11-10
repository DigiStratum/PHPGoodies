<?php
/**
  * PHPGoodies:WbrElement - WBR Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * WbrElement - WBR Element
 */
class WbrElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('wbr', 'block');
	}
}

