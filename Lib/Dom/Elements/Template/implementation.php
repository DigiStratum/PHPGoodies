<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Template - TEMPLATE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.ContentAttribute');

/**
 * Template - TEMPLATE Element
 */
class Lib_Dom_Elements_Template extends Lib_Dom_Node_Element {
	use ContentAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('template', 'block');
	}
}

