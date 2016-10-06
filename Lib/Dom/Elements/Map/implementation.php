<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Map - MAP Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.NameAttribute');

/**
 * Map - MAP Element
 */
class Lib_Dom_Elements_Map extends Lib_Dom_Node_Element {
	use NameAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('map', 'block');
	}
}

