<?php
/**
  * PHPGoodies:InsElement - INS Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.CiteAttribute');
PHPGoodies::import('Lib.Dom.Attributes.DateTimeAttribute');

/**
 * InsElement - INS Element
 */
class InsElement extends NodeElement {
	use CiteAttribute, DateTimeAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('ins', 'block');
	}
}

