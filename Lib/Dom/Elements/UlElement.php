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
PHPGoodies::import('Lib.Dom.Attributes.CompactAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TypeAttribute');

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

