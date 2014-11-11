<?php
/**
  * PHPGoodies:ArticleElement - ARTICLE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * ArticleElement - ARTICLE Element
 */
class ArticleElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('article', 'block');
	}
}

