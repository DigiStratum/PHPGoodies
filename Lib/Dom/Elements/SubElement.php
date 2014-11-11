<?php
/**
  * PHPGoodies:SubElement - SUB Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * SubElement - SUB Element
 */
class SubElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('sub', 'block');
	}
}

