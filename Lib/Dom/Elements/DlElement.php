<?php
/**
  * PHPGoodies:DlElement - DL Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * DlElement - DL Element
 */
class DlElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('dl', 'block');
	}
}
