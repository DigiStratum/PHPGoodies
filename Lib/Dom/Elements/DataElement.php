<?php
/**
  * PHPGoodies:ValueElement - VALUE Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.ValueAttribute');

/**
 * ValueElement - VALUE Element
 */
class ValueElement extends NodeElement {
	use ValueAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('value', 'block');
	}
}

