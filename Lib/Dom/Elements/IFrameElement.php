<?php
/**
  * PHPGoodies:IFrameElement - IFRAME Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AlignAttribute');
PHPGoodies::import('Lib.Dom.Attributes.AllowFullScreenAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FrameBorderAttribute');
PHPGoodies::import('Lib.Dom.Attributes.HeightAttribute');
PHPGoodies::import('Lib.Dom.Attributes.LongDescAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MarginHeightAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MarginWidthAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MozAllowFullScreenAttribute');
PHPGoodies::import('Lib.Dom.Attributes.WebkitAllowFullScreenAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MozAppAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MozBrowserAttribute');
PHPGoodies::import('Lib.Dom.Attributes.NameAttribute');
PHPGoodies::import('Lib.Dom.Attributes.RemoteAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ScrollingAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SandboxAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SeamlessAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SrcAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SrcDocAttribute');
PHPGoodies::import('Lib.Dom.Attributes.WidthAttribute');


/**
 * IFrameElement - IFRAME Element
 */
class IFrameElement extends NodeElement {
	use AlignAttribute, AllowFullScreenAttribute, FrameBorderAttribute, HeightAttribute;
	use LongDescAttribute, MarginHeightAttribute, MarginWidthAttribute;
	use MozAllowFullScreenAttribute, WebkitAllowFullScreenAttribute, MozAppAttribute;
	use MozBrowserAttribute, NameAttribute, RemoteAttribute, ScrollingAttribute;
	use SandboxAttribute, SeamlessAttribute, SrcAttribute, SrcDocAttribute, WidthAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('iframe', 'block');
	}
}

