<?php
/**
  * PHPGoodies:SpanElement - SPAN Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * SpanElement - SPAN Element
 */
class SpanElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('span', 'block');
	}
}

