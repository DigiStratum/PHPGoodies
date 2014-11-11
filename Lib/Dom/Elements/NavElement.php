<?php
/**
  * PHPGoodies:NavElement - NAV Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * NavElement - NAV Element
 */
class NavElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('nav', 'block');
	}
}

