<?php
/**
  * PHPGoodies:LiElement - LI Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.ValueAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TypeAttribute');

/**
 * LiElement - LI Element
 */
class LiElement extends NodeElement {
	use ValueAttribute, TypeAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('li', 'block');
	}
}

