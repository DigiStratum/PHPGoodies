<?php
/**
  * PHPGoodies:Lib_Dom_Elements_A - A Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.DownloadAttribute');
PHPGoodies::import('Lib.Dom.Attributes.HrefAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MediaAttribute');
PHPGoodies::import('Lib.Dom.Attributes.PingAttribute');
PHPGoodies::import('Lib.Dom.Attributes.RelAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TargetAttribute');
PHPGoodies::import('Lib.Dom.Attributes.CharSetAttribute');
PHPGoodies::import('Lib.Dom.Attributes.CoordsAttribute');
PHPGoodies::import('Lib.Dom.Attributes.DataFldAttribute');
PHPGoodies::import('Lib.Dom.Attributes.DataSrcAttribute');
PHPGoodies::import('Lib.Dom.Attributes.HrefLangAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MethodsAttribute');
PHPGoodies::import('Lib.Dom.Attributes.NameAttribute');
PHPGoodies::import('Lib.Dom.Attributes.RevAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ShapeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TypeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.UrnAttribute');

/**
 * A - A Element
 */
class Lib_Dom_Elements_A extends Lib_Dom_Node_Element {
	use DownloadAttribute, HrefAttribute, MediaAttribute, PingAttribute, RelAttribute;
	use TargetAttribute, CharSetAttribute, CoordsAttribute, DataFldAttribute, DataSrcAttribute;
	use HrefLangAttribute, MethodsAttribute, NameAttribute, RevAttribute, ShapeAttribute;
	use TypeAttribute, UrnAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('a', 'block');
	}
}

