<?php
/**
  * PHPGoodies:BodyElement - BODY Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.BackgroundAttribute');
PHPGoodies::import('Lib.Dom.Attributes.BGColorAttribute');
PHPGoodies::import('Lib.Dom.Attributes.BottomMarginAttribute');
PHPGoodies::import('Lib.Dom.Attributes.LeftMarginAttribute');
PHPGoodies::import('Lib.Dom.Attributes.LinkAttribute');
PHPGoodies::import('Lib.Dom.Attributes.OnAfterPrintAttribute');
PHPGoodies::import('Lib.Dom.Attributes.OnBeforePrintAttribute');
PHPGoodies::import('Lib.Dom.Attributes.OnBeforeUnloadAttribute');
PHPGoodies::import('Lib.Dom.Attributes.OnBlurAttribute');
PHPGoodies::import('Lib.Dom.Attributes.OnErrorAttribute');
PHPGoodies::import('Lib.Dom.Attributes.OnFocusAttribute');
PHPGoodies::import('Lib.Dom.Attributes.OnHashChangeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.OnLanguageChangeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.OnLoadAttribute');
PHPGoodies::import('Lib.Dom.Attributes.OnMessageAttribute');
PHPGoodies::import('Lib.Dom.Attributes.OnOfflineAttribute');
PHPGoodies::import('Lib.Dom.Attributes.OnOnlineAttribute');
PHPGoodies::import('Lib.Dom.Attributes.OnPopStateAttribute');
PHPGoodies::import('Lib.Dom.Attributes.OnRedoAttribute');
PHPGoodies::import('Lib.Dom.Attributes.OnResizeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.OnStorageAttribute');
PHPGoodies::import('Lib.Dom.Attributes.OnUndoAttribute');
PHPGoodies::import('Lib.Dom.Attributes.OnUnloadAttribute');
PHPGoodies::import('Lib.Dom.Attributes.RightMarginAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TextAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TopMarginAttribute');
PHPGoodies::import('Lib.Dom.Attributes.VLinkAttribute');


/**
 * BodyElement - BODY Element
 */
class BodyElement extends NodeElement {
	use BackgroundAttribute, BGColorAttribute, BottomMarginAttribute, LeftMarginAttribute;
       	use LinkAttribute, OnAfterPrintAttribute, OnBeforePrintAttribute, OnBeforeUnloadAttribute;
	use OnBlurAttribute, OnErrorAttribute, OnFocusAttribute, OnHashChangeAttribute;
	use OnLanguageChangeAttribute, OnLoadAttribute, OnMessageAttribute, OnOfflineAttribute;
	use OnOnlineAttribute, OnPopStateAttribute, OnRedoAttribute, OnResizeAttribute;
	use OnStorageAttribute, OnUndoAttribute, OnUnloadAttribute, RightMarginAttribute;
	use TextAttribute, TopMarginAttribute, VLinkAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('body', 'block');
	}
}

