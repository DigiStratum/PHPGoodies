<?php
/**
  * PHPGoodies:ImgElement - IMG Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

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
 * ImgElement - IMG Element
 */
class ImgElement extends NodeElement {
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

