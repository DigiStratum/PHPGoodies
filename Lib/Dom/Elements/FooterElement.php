<?php
/**
  * PHPGoodies:FooterElement - FOOTER Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * FooterElement - FOOTER Element
 */
class FooterElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('footer', 'block');
	}
}

