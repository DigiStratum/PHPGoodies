<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Meter - METER Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.ValueAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MinAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MaxAttribute');
PHPGoodies::import('Lib.Dom.Attributes.LowAttribute');
PHPGoodies::import('Lib.Dom.Attributes.HighAttribute');
PHPGoodies::import('Lib.Dom.Attributes.OptimumAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FormAttribute');

/**
 * Meter - METER Element
 */
class Lib_Dom_Elements_Meter extends Lib_Dom_Node_Element {
	use ValueAttribute, MinAttribute, MaxAttribute, LowAttribute, HighAttribute;
	use OptimumAttribute, FormAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('meter', 'block');
	}
}

