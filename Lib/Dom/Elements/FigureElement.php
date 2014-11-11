<?php
/**
  * PHPGoodies:FigureElement - FIGURE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * FigureElement - FIGURE Element
 */
class FigureElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('figure', 'block');
	}
}

