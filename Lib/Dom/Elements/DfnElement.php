<?php
/**
  * PHPGoodies:DfnElement - DFN Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * DfnElement - DFN Element
 */
class DfnElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('dfn', 'block');
	}
}

