<?php
/**
  * PHPGoodies:MarkElement - MARK Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * MarkElement - MARK Element
 */
class MarkElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('mark', 'block');
	}
}

