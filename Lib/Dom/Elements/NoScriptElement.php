<?php
/**
  * PHPGoodies:NoScriptElement - NOSCRIPT Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * NoScriptElement - NOSCRIPT Element
 */
class NoScriptElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('noscript', 'block');
	}
}

