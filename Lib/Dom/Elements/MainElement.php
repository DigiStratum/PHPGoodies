<?php
/**
  * PHPGoodies:MainElement - MAIN Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * MainElement - MAIN Element
 */
class MainElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('main', 'block');
	}
}

