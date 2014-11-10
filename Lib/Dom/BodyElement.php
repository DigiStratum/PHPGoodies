<?php
/**
  * PHPGoodies:BodyElement - BODY Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.BackgroundAttribute');
PHPGoodies::import('Lib.Dom.BGColorAttribute');
PHPGoodies::import('Lib.Dom.BottomMarginAttribute');
PHPGoodies::import('Lib.Dom.LeftMarginAttribute');
PHPGoodies::import('Lib.Dom.LinkAttribute');
PHPGoodies::import('Lib.Dom.OnAfterPrintAttribute');
PHPGoodies::import('Lib.Dom.OnBeforePrintAttribute');
PHPGoodies::import('Lib.Dom.OnBeforeUnloadAttribute');
PHPGoodies::import('Lib.Dom.OnBlurAttribute');
PHPGoodies::import('Lib.Dom.OnErrorAttribute');
PHPGoodies::import('Lib.Dom.OnFocusAttribute');
PHPGoodies::import('Lib.Dom.OnHashChangeAttribute');
PHPGoodies::import('Lib.Dom.OnLanguageChangeAttribute');
PHPGoodies::import('Lib.Dom.OnLoadAttribute');
PHPGoodies::import('Lib.Dom.OnMessageAttribute');
PHPGoodies::import('Lib.Dom.OnOfflineAttribute');
PHPGoodies::import('Lib.Dom.OnOnlineAttribute');
PHPGoodies::import('Lib.Dom.OnPopStateAttribute');
PHPGoodies::import('Lib.Dom.OnRedoAttribute');
PHPGoodies::import('Lib.Dom.OnResizeAttribute');
PHPGoodies::import('Lib.Dom.OnStorageAttribute');
PHPGoodies::import('Lib.Dom.OnUndoAttribute');
PHPGoodies::import('Lib.Dom.OnUnloadAttribute');
PHPGoodies::import('Lib.Dom.RightMarginAttribute');
PHPGoodies::import('Lib.Dom.TextAttribute');
PHPGoodies::import('Lib.Dom.TopMarginAttribute');
PHPGoodies::import('Lib.Dom.VLinkAttribute');


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

