<?php
/**
  * PHPGoodies:AreaElement - AREA Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AccessKeyAttribute');
PHPGoodies::import('Lib.Dom.Attributes.AltAttribute');
PHPGoodies::import('Lib.Dom.Attributes.CoordsAttribute');
PHPGoodies::import('Lib.Dom.Attributes.DownloadsAttribute');
PHPGoodies::import('Lib.Dom.Attributes.HrefAttribute');
PHPGoodies::import('Lib.Dom.Attributes.HrefLangAttribute');
PHPGoodies::import('Lib.Dom.Attributes.NameAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MediaAttribute');
PHPGoodies::import('Lib.Dom.Attributes.NoHrefAttribute');
PHPGoodies::import('Lib.Dom.Attributes.RelAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ShapeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TabIndexAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TargetAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TypeAttribute');

/**
 * AreaElement - AREA Element
 */
class AreaElement extends NodeElement {
	use AccessKeyAttribute, AltAttribute, CoordsAttribute, DownloadsAttribute, HrefAttribute;
	use HrefLangAttribute, NameAttribute, MediaAttribute, NoHrefAttribute, RelAttribute;
	use ShapeAttribute, TabIndexAttribute, TargetAttribute, TypeAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('area', 'block');
	}
}

