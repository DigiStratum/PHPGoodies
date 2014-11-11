<?php
/**
  * PHPGoodies:DelElement - DEL Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.CiteAttribute');
PHPGoodies::import('Lib.Dom.Attributes.DateTimeAttribute');

/**
 * DelElement - DEL Element
 */
class DelElement extends NodeElement {
	use CiteAttribute, DateTimeAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('del', 'block');
	}
}

