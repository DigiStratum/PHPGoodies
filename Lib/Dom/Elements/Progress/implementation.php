<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Progress - PROGRESS Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.MaxAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ValueAttribute');

/**
 * Progress - PROGRESS Element
 */
class Lib_Dom_Elements_Progress extends Lib_Dom_Node_Element {
	use MaxAttribute, ValueAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('progress', 'block');
	}
}

