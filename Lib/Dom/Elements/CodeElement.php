<?php
/**
  * PHPGoodies:CodeElement - CODE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * CodeElement - CODE Element
 */
class CodeElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('code', 'block');
	}
}

