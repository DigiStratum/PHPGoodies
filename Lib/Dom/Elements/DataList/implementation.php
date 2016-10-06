<?php
/**
  * PHPGoodies:Lib_Dom_Elements_DataList - DATALIST Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * DataList - DATALIST Element
 */
class Lib_Dom_Elements_DataList extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('datalist', 'block');
	}
}

