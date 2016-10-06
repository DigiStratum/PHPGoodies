<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Del - DEL Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.CiteAttribute');
PHPGoodies::import('Lib.Dom.Attributes.DateTimeAttribute');

/**
 * Del - DEL Element
 */
class Lib_Dom_Elements_Del extends Lib_Dom_Node_Element {
	use CiteAttribute, DateTimeAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('del', 'block');
	}
}

