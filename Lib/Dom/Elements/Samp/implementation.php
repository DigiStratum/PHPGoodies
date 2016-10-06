<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Samp - SAMP Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Samp - SAMP Element
 */
class Lib_Dom_Elements_Samp extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('samp', 'block');
	}
}

