<?php
/**
  * PHPGoodies:ProgressElement - PROGRESS Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.MaxAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ValueAttribute');

/**
 * ProgressElement - PROGRESS Element
 */
class ProgressElement extends NodeElement {
	use MaxAttribute, ValueAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('progress', 'block');
	}
}

