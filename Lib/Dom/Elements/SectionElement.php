<?php
/**
  * PHPGoodies:SectionElement - SECTION Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

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

