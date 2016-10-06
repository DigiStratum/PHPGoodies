<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Output - OUTPUT Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.ForAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FormAttribute');
PHPGoodies::import('Lib.Dom.Attributes.NameAttribute');

/**
 * Output - OUTPUT Element
 */
class Lib_Dom_Elements_Output extends Lib_Dom_Node_Element {
	use ForAttribute, FormAttribute, NameAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('output', 'block');
	}
}

