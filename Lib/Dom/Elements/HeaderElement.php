<?php
/**
  * PHPGoodies:HeaderElement - HEADER Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * HeaderElement - HEADER Element
 */
class HeaderElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('header', 'block');
	}
}

