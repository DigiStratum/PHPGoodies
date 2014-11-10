<?php
/**
  * PHPGoodies:SmallElement - SMALL Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * SmallElement - SMALL Element
 */
class SmallElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('small', 'block');
	}
}

