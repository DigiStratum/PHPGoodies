<?php
/**
  * PHPGoodies:CanvasElement - CANVAS Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.HeightAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MozOpaqueAttribute');
PHPGoodies::import('Lib.Dom.Attributes.WidthAttribute');

/**
 * CanvasElement - CANVAS Element
 */
class CanvasElement extends NodeElement {
	use HeightAttribute, MozOpaqueAttribute, WidthAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('canvas', 'block');
	}
}

