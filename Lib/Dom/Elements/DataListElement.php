<?php
/**
  * PHPGoodies:DataListElement - DATALIST Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * DataListElement - DATALIST Element
 */
class DataListElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('datalist', 'block');
	}
}

