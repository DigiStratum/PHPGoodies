<?php
/**
  * PHPGoodies:DtElement - DT Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * DtElement - DT Element
 */
class DtElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('dt', 'block');
	}
}

