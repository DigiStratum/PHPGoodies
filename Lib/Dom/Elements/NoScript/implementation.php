<?php
/**
  * PHPGoodies:Lib_Dom_Elements_NoScript - NOSCRIPT Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * NoScript - NOSCRIPT Element
 */
class Lib_Dom_Elements_NoScript extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('noscript', 'block');
	}
}

