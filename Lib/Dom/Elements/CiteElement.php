<?php
/**
  * PHPGoodies:CiteElement - CITE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * CiteElement - CITE Element
 */
class CiteElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('cite', 'block');
	}
}

