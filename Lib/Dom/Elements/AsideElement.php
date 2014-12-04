<?php
/**
  * PHPGoodies:AsideElement - ASIDE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * AsideElement - ASIDE Element
 */
class AsideElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('aside', 'block');
	}
}

