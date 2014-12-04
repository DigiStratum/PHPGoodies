<?php
/**
  * PHPGoodies:RubyElement - RUBY Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * RubyElement - RUBY Element
 */
class RubyElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('ruby', 'block');
	}
}

