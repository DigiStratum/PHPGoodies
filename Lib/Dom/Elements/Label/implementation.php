<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Label - LABEL Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AccessKeyAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ForAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FormAttribute');

/**
 * Label - LABEL Element
 */
class Lib_Dom_Elements_Label extends Lib_Dom_Node_Element {
	use AccessKeyAttribute, ForAttribute, FormAttribute; 
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('label', 'block');
	}
}

