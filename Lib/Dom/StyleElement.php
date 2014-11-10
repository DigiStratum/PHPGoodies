<?php
/**
  * PHPGoodies:StyleElement - STYLE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.TypeAttribute');
PHPGoodies::import('Lib.Dom.MediaAttribute');
PHPGoodies::import('Lib.Dom.ScopedAttribute');
PHPGoodies::import('Lib.Dom.TitleAttribute');
PHPGoodies::import('Lib.Dom.DisabledAttribute');


/**
 * StyleElement - STYLE Element
 */
class StyleElement extends NodeElement {
	use TypeAttribute, MediaAttribute, ScopedAttribute, TitleAttribute, DisabledAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('style', 'block');
	}
}

