<?php
/**
  * PHPGoodies:BElement - B Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * BElement - B Element
 */
class BElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('b', 'block');
	}
}

