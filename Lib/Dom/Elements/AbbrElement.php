<?php
/**
  * PHPGoodies:AbbrElement - ABBR Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * AbbrElement - ABBR Element
 */
class AbbrElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('abbr', 'block');
	}
}

