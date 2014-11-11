<?php
/**
  * PHPGoodies:SvgElement - SVG Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

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
 * SvgElement - SVG Element
 */
class SvgElement extends NodeElement {
	use XAttribute, YAttribute, WidthAttribute, HeightAttribute, PreserveAspectRatioAttribute;
	use ContentScriptTypeAttribute, ContentStyleTypeAttribute, ViewBoxAttribute; 

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('svg', 'block');
	}
}

