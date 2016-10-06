<?php
/**
  * PHPGoodies:Lib_Dom_Elements_BlockQuote - BLOCKQUOTE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.CiteAttribute');

/**
 * BlockQuote - BLOCKQUOTE Element
 */
class Lib_Dom_Elements_BlockQuote extends Lib_Dom_Node_Element {
	use CiteAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('blockquote', 'block');
	}
}

