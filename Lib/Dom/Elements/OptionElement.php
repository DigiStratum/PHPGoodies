<?php
/**
  * PHPGoodies:OptionElement - OPTION Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.DisabledAttribute');
PHPGoodies::import('Lib.Dom.Attributes.LabelAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SelectedAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ValueAttribute');

/**
 * OptionElement - OPTION Element
 */
class OptionElement extends NodeElement {
	use DisabledAttribute, LabelAttribute, SelectedAttribute, ValueAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('option', 'block');
	}
}

