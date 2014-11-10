<?php
/**
  * PHPGoodies:RtElement - RT Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * RtElement - RT Element
 */
class RtElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('rt', 'block');
	}
}

