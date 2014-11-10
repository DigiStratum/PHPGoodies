<?php
/**
  * PHPGoodies:OlElement - OL Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.CompactAttribute');
PHPGoodies::import('Lib.Dom.ReversedAttribute');
PHPGoodies::import('Lib.Dom.StartAttribute');
PHPGoodies::import('Lib.Dom.TypeAttribute');

/**
 * OlElement - OL Element
 */
class OlElement extends NodeElement {
	use CompactAttribute, ReversedAttribute, StartAttribute, TypeAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('ol', 'block');
	}
}

