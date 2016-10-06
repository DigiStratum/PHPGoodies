<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Time - TIME Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.DateTimeAttribute');

/**
 * Time - TIME Element
 */
class Lib_Dom_Elements_Time extends Lib_Dom_Node_Element {
	use DateTimeAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('time', 'block');
	}
}

