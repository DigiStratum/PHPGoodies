<?php
/**
  * PHPGoodies:BdiElement - BDI Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * BdiElement - BDI Element
 */
class BdiElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('bdi', 'block');
	}
}

