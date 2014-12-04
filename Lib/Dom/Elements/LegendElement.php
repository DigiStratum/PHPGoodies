<?php
/**
  * PHPGoodies:LegendElement - LEGEND Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * LegendElement - LEGEND Element
 */
class LegendElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('legend', 'block');
	}
}

