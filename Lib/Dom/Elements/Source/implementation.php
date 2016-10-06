<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Source - SOURCE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.SizesAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SrcAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SrcSetAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TypeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MediaAttribute');

/**
 * Source - SOURCE Element
 */
class Lib_Dom_Elements_Source extends Lib_Dom_Node_Element {
	use SizesAttribute, SrcAttribute, SrcSetAttribute, TypeAttribute, MediaAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('source', 'block');
	}
}

