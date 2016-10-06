<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Article - ARTICLE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

/**
 * Article - ARTICLE Element
 */
class Lib_Dom_Elements_Article extends Lib_Dom_Node_Element {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('article', 'block');
	}
}

