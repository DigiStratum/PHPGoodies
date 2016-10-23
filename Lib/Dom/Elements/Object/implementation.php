<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Object - OBJECT Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.ArchiveAttribute');
PHPGoodies::import('Lib.Dom.Attributes.BorderAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ClassIdAttribute');
PHPGoodies::import('Lib.Dom.Attributes.CodeBaseAttribute');
PHPGoodies::import('Lib.Dom.Attributes.CodeTypeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.DataAttribute');
PHPGoodies::import('Lib.Dom.Attributes.DeclareAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FormAttribute');
PHPGoodies::import('Lib.Dom.Attributes.HeightAttribute');
PHPGoodies::import('Lib.Dom.Attributes.NameAttribute');
PHPGoodies::import('Lib.Dom.Attributes.StandByAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TabIndexAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TypeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TypeMustMatchAttribute');
PHPGoodies::import('Lib.Dom.Attributes.UseMapAttribute');
PHPGoodies::import('Lib.Dom.Attributes.WidthAttribute');

/**
 * Object - OBJECT Element
 */
class Lib_Dom_Elements_Object extends Lib_Dom_Node_Element {
	use ArchiveAttribute, BorderAttribute, ClassIdAttribute, CodeBaseAttribute;
	use CodeTypeAttribute, DataAttribute, DeclareAttribute, FormAttribute, HeightAttribute;
	use NameAttribute, StandByAttribute, TabIndexAttribute, TypeAttribute;
	use TypeMustMatchAttribute, UseMapAttribute, WidthAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('object', 'block');
	}
}
