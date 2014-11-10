<?php
/**
  * PHPGoodies:UlElement - UL Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.CompactAttribute');
PHPGoodies::import('Lib.Dom.TypeAttribute');

/**
 * UlElement - UL Element
 */
class UlElement extends NodeElement {
	use CompactAttribute, TypeAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('ul', 'block');
	}
}

