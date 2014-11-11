<?php
/**
  * PHPGoodies:RpElement - RP Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * RpElement - RP Element
 */
class RpElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('rp', 'block');
	}
}
