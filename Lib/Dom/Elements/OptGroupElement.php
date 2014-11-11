<?php
/**
  * PHPGoodies:OptGroupElement - OPTGROUP Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.DisabledAttribute');
PHPGoodies::import('Lib.Dom.Attributes.LabelAttribute');

/**
 * OptGroupElement - OPTGROUP Element
 */
class OptGroupElement extends NodeElement {
	use DisabledAttribute, LabelAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('optgroup', 'block');
	}
}

