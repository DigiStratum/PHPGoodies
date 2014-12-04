<?php
/**
  * PHPGoodies:StyleElement - STYLE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.TypeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MediaAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ScopedAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TitleAttribute');
PHPGoodies::import('Lib.Dom.Attributes.DisabledAttribute');


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

