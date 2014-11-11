<?php
/**
  * PHPGoodies:LabelElement - LABEL Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AccessKeyAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ForAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FormAttribute');

/**
 * LabelElement - LABEL Element
 */
class LabelElement extends NodeElement {
	use AccessKeyAttribute, ForAttribute, FormAttribute; 
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('label', 'block');
	}
}

