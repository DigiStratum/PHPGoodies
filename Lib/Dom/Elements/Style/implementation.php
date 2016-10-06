<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Style - STYLE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.TypeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MediaAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ScopedAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TitleAttribute');
PHPGoodies::import('Lib.Dom.Attributes.DisabledAttribute');


/**
 * Style - STYLE Element
 */
class Lib_Dom_Elements_Style extends Lib_Dom_Node_Element {
	use TypeAttribute, MediaAttribute, ScopedAttribute, TitleAttribute, DisabledAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('style', 'block');
	}
}

