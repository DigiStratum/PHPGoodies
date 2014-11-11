<?php
/**
  * PHPGoodies:ScriptElement - SCRIPT Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AsyncAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SrcAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TypeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.LanguageAttribute');
PHPGoodies::import('Lib.Dom.Attributes.DeferAttribute');
PHPGoodies::import('Lib.Dom.Attributes.CrossOriginAttribute');

/**
 * ScriptElement - SCRIPT Element
 */
class ScriptElement extends NodeElement {
	use AsyncAttribute, SrcAttribute, TypeAttribute, LanguageAttribute, DeferAttribute, CrossOriginAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('script', 'block');
	}
}

