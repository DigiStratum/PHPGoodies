<?php
/**
  * PHPGoodies:TimeElement - TIME Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.DateTimeAttribute');

/**
 * TimeElement - TIME Element
 */
class TimeElement extends NodeElement {
	use DateTimeAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('time', 'block');
	}
}

