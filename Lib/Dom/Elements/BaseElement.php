<?php
/**
  * PHPGoodies:BaseElement - BASE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.HrefAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TargetAttribute');

/**
 * BaseElement - BASE Element
 */
class BaseElement extends NodeElement {
	use HrefAttribute, TargetAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('base', 'inline');
	}
}

