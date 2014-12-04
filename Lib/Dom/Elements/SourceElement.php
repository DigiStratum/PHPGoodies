<?php
/**
  * PHPGoodies:SourceElement - SOURCE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.SizesAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SrcAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SrcSetAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TypeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MediaAttribute');

/**
 * SourceElement - SOURCE Element
 */
class SourceElement extends NodeElement {
	use SizesAttribute, SrcAttribute, SrcSetAttribute, TypeAttribute, MediaAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('source', 'block');
	}
}

