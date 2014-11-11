<?php
/**
  * PHPGoodies:MeterElement - METER Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.ValueAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MinAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MaxAttribute');
PHPGoodies::import('Lib.Dom.Attributes.LowAttribute');
PHPGoodies::import('Lib.Dom.Attributes.HighAttribute');
PHPGoodies::import('Lib.Dom.Attributes.OptimumAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FormAttribute');

/**
 * MeterElement - METER Element
 */
class MeterElement extends NodeElement {
	use ValueAttribute, MinAttribute, MaxAttribute, LowAttribute, HighAttribute;
	use OptimumAttribute, FormAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('meter', 'block');
	}
}

