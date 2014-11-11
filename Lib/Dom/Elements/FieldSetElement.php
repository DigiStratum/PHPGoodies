<?php
/**
  * PHPGoodies:FieldSetElement - FIELDSET Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.DisabledAttribute');
PHPGoodies::import('Lib.Dom.Attributes.FormAttribute');
PHPGoodies::import('Lib.Dom.Attributes.NameAttribute');

/**
 * FieldSetElement - FIELDSET Element
 */
class FieldSetElement extends NodeElement {
	use DisabledAttribute, FormAttribute, NameAttribute; 
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('fieldset', 'block');
	}
}

