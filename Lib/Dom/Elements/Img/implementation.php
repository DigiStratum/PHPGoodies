<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Img - IMG Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AlignAttribute');
PHPGoodies::import('Lib.Dom.Attributes.AltAttribute');
PHPGoodies::import('Lib.Dom.Attributes.BorderAttribute');
PHPGoodies::import('Lib.Dom.Attributes.CrossOriginAttribute');
PHPGoodies::import('Lib.Dom.Attributes.HeightAttribute');
PHPGoodies::import('Lib.Dom.Attributes.HSpaceAttribute');
PHPGoodies::import('Lib.Dom.Attributes.IsMapAttribute');
PHPGoodies::import('Lib.Dom.Attributes.LongDescAttribute');
PHPGoodies::import('Lib.Dom.Attributes.NameAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SrcAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SizesAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SrcSetAttribute');
PHPGoodies::import('Lib.Dom.Attributes.WidthAttribute');
PHPGoodies::import('Lib.Dom.Attributes.UseMapAttribute');
PHPGoodies::import('Lib.Dom.Attributes.VSpaceAttribute');

/**
 * Img - IMG Element
 */
class Lib_Dom_Elements_Img extends Lib_Dom_Node_Element {
	use AlignAttribute, AltAttribute, BorderAttribute, CrossOriginAttribute, HeightAttribute;
	use HSpaceAttribute, IsMapAttribute, LongDescAttribute, NameAttribute, SrcAttribute;
	use SizesAttribute, SrcSetAttribute, WidthAttribute, UseMapAttribute, VSpaceAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('img', 'block');
	}
}

