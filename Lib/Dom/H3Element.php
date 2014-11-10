<?php
/**
  * PHPGoodies:H3Element - H3 Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.AlignAttribute');


/**
 * H3Element - H3 Element
 */
class H3Element extends NodeElement {
	use AlignAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('h3', 'block');
	}
}

