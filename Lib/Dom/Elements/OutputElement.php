<?php
/**
  * PHPGoodies:OutputElement - OUTPUT Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.ForAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FormAttribute');
PHPGoodies::import('Lib.Dom.Attributes.NameAttribute');

/**
 * OutputElement - OUTPUT Element
 */
class OutputElement extends NodeElement {
	use ForAttribute, FormAttribute, NameAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('output', 'block');
	}
}

