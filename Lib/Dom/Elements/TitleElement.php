<?php
/**
  * PHPGoodies:TitleElement - TITLE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * TitleElement - TITLE Element
 */
class TitleElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('title', 'block');
	}
}

