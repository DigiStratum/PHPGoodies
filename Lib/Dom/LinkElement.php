<?php
/**
  * PHPGoodies:LinkElement - LINK Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.CharSetAttribute');
PHPGoodies::import('Lib.Dom.CrossOriginAttribute');
PHPGoodies::import('Lib.Dom.DisabledAttribute');
PHPGoodies::import('Lib.Dom.HrefAttribute');
PHPGoodies::import('Lib.Dom.HrefLangAttribute');
PHPGoodies::import('Lib.Dom.MediaAttribute');
PHPGoodies::import('Lib.Dom.MethodsAttribute');
PHPGoodies::import('Lib.Dom.RelAttribute');
PHPGoodies::import('Lib.Dom.RevAttribute');
PHPGoodies::import('Lib.Dom.SizesAttribute');
PHPGoodies::import('Lib.Dom.TargetAttribute');
PHPGoodies::import('Lib.Dom.TypeAttribute');

/**
 * LinkElement - LINK Element
 */
class LinkElement extends NodeElement {
	use CharSetAttribute, CrossOriginAttribute, DisabledAttribute, HrefAttribute;
	use HrefLangAttribute, MediaAttribute, MethodsAttribute, RelAttribute, RevAttribute;
	use SizesAttribute, TargetAttribute, TypeAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('link', 'inline');
	}
}

