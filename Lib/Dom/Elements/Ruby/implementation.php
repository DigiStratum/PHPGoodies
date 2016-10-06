<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Ruby - RUBY Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Ruby - RUBY Element
 */
class Lib_Dom_Elements_Ruby extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('ruby', 'block');
	}
}

