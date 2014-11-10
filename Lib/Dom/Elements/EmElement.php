<?php
/**
  * PHPGoodies:EmElement - EM Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * EmElement - EM Element
 */
class EmElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('em', 'block');
	}
}

