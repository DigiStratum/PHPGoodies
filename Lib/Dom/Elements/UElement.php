<?php
/**
  * PHPGoodies:UElement - U Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * UElement - U Element
 */
class UElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('u', 'block');
	}
}

