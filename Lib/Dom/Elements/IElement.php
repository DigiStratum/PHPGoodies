<?php
/**
  * PHPGoodies:IElement - I Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * IElement - I Element
 */
class IElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('i', 'block');
	}
}

