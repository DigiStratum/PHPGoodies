<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Script - SCRIPT Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AsyncAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SrcAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TypeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.LanguageAttribute');
PHPGoodies::import('Lib.Dom.Attributes.DeferAttribute');
PHPGoodies::import('Lib.Dom.Attributes.CrossOriginAttribute');

/**
 * Script - SCRIPT Element
 */
class Lib_Dom_Elements_Script extends Lib_Dom_Node_Element {
	use AsyncAttribute, SrcAttribute, TypeAttribute, LanguageAttribute, DeferAttribute, CrossOriginAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('script', 'block');
	}
}

