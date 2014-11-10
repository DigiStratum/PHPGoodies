<?php
/**
  * PHPGoodies:MainElement - MAIN Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * MainElement - MAIN Element
 */
class MainElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('main', 'block');
	}
}

