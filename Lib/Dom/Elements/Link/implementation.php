<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Link - LINK Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.CharSetAttribute');
PHPGoodies::import('Lib.Dom.Attributes.CrossOriginAttribute');
PHPGoodies::import('Lib.Dom.Attributes.DisabledAttribute');
PHPGoodies::import('Lib.Dom.Attributes.HrefAttribute');
PHPGoodies::import('Lib.Dom.Attributes.HrefLangAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MediaAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MethodsAttribute');
PHPGoodies::import('Lib.Dom.Attributes.RelAttribute');
PHPGoodies::import('Lib.Dom.Attributes.RevAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SizesAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TargetAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TypeAttribute');

/**
 * Link - LINK Element
 */
class Lib_Dom_Elements_Link extends Lib_Dom_Node_Element {
	use CharSetAttribute, CrossOriginAttribute, DisabledAttribute, HrefAttribute;
	use HrefLangAttribute, MediaAttribute, MethodsAttribute, RelAttribute, RevAttribute;
	use SizesAttribute, TargetAttribute, TypeAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('link', 'inline');
	}
}

