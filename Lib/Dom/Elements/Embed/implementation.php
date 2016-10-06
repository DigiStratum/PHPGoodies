<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Embed - EMBED Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.HeightAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SrcAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TypeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.WidthAttribute');

/**
 * Embed - EMBED Element
 */
class Lib_Dom_Elements_Embed extends Lib_Dom_Node_Element {
	use HeightAttribute, TypeAttribute, SrcAttribute, WidthAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('embed', 'block');
	}
}

