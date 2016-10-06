<?php
/**
  * PHPGoodies:Lib_Dom_Elements_FieldSet - FIELDSET Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.DisabledAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FormAttribute');
PHPGoodies::import('Lib.Dom.Attributes.NameAttribute');

/**
 * FieldSet - FIELDSET Element
 */
class Lib_Dom_Elements_FieldSet extends Lib_Dom_Node_Element {
	use DisabledAttribute, FormAttribute, NameAttribute; 
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('fieldset', 'block');
	}
}

