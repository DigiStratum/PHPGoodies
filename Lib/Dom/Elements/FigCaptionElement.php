<?php
/**
  * PHPGoodies:FigCaptionElement - FIGCAPTION Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * FigCaptionElement - FIGCAPTION Element
 */
class FigCaptionElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('figcaption', 'block');
	}
}

