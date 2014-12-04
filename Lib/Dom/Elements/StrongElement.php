<?php
/**
  * PHPGoodies:StrongElement - STRONG Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * StrongElement - STRONG Element
 */
class StrongElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('strong', 'block');
	}
}

