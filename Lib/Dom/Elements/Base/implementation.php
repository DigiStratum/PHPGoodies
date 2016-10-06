<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Base - BASE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.HrefAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TargetAttribute');

/**
 * Base - BASE Element
 */
class Lib_Dom_Elements_Base extends Lib_Dom_Node_Element {
	use HrefAttribute, TargetAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('base', 'inline');
	}
}

