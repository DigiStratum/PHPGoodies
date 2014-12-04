<?php
/**
  * PHPGoodies:SupElement - SUP Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * SupElement - SUP Element
 */
class SupElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('sup', 'block');
	}
}

