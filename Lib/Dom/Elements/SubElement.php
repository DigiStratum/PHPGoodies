<?php
/**
  * PHPGoodies:SubElement - SUB Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

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

