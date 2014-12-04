<?php
/**
  * PHPGoodies:ArticleElement - ARTICLE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

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

