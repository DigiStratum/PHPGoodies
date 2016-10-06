<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Svg - SVG Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.VersionAttribute');
PHPGoodies::import('Lib.Dom.Attributes.BaseProfileAttribute');
PHPGoodies::import('Lib.Dom.Attributes.XAttribute');
PHPGoodies::import('Lib.Dom.Attributes.YAttribute');
PHPGoodies::import('Lib.Dom.Attributes.WidthAttribute');
PHPGoodies::import('Lib.Dom.Attributes.HeightAttribute');
PHPGoodies::import('Lib.Dom.Attributes.PreserveAspectRatioAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ContentScriptTypeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ContentStyleTypeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ViewBoxAttribute');

/**
 * Svg - SVG Element
 */
class Lib_Dom_Elements_Svg extends Lib_Dom_Node_Element {
	use XAttribute, YAttribute, WidthAttribute, HeightAttribute, PreserveAspectRatioAttribute;
	use ContentScriptTypeAttribute, ContentStyleTypeAttribute, ViewBoxAttribute; 

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('svg', 'block');
	}
}

