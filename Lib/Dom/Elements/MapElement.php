<?php
/**
  * PHPGoodies:MapElement - MAP Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.NameAttribute');

/**
 * MapElement - MAP Element
 */
class MapElement extends NodeElement {
	use NameAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('map', 'block');
	}
}

