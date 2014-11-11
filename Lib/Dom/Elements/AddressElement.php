<?php
/**
  * PHPGoodies:AddressElement - ADDRESS Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * AddressElement - ADDRESS Element
 */
class AddressElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('address', 'block');
	}
}

