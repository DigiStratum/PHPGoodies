<?php
/**
  * PHPGoodies:SElement - S Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * SElement - S Element
 */
class SElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('s', 'block');
	}
}

