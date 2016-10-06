<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Meta - META Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.CharSetAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ContentAttribute');
PHPGoodies::import('Lib.Dom.Attributes.HttpEquivAttribute');
PHPGoodies::import('Lib.Dom.Attributes.NameAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SchemeAttribute');

/**
 * Meta - META Element
 */
class Lib_Dom_Elements_Meta extends Lib_Dom_Node_Element {
	use CharSetAttribute, ContentAttribute, HttpEquivAttribute, NameAttribute, SchemeAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('meta', 'inline');
	}
}

