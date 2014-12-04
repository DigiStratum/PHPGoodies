<?php
/**
  * PHPGoodies:TemplateElement - TEMPLATE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.ContentAttribute');

/**
 * TemplateElement - TEMPLATE Element
 */
class TemplateElement extends NodeElement {
	use ContentAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('template', 'block');
	}
}

