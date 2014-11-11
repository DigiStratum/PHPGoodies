<?php
/**
  * PHPGoodies:SectionElement - SECTION Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * SectionElement - SECTION Element
 */
class SectionElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('section', 'block');
	}
}

