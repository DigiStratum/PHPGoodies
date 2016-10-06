<?php
/**
  * PHPGoodies:Lib_Dom_Elements_FigCaption - FIGCAPTION Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * FigCaption - FIGCAPTION Element
 */
class Lib_Dom_Elements_FigCaption extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('figcaption', 'block');
	}
}

