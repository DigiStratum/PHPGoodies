<?php
/**
  * PHPGoodies:MetaElement - META Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.CharSetAttribute');
PHPGoodies::import('Lib.Dom.ContentAttribute');
PHPGoodies::import('Lib.Dom.HttpEquivAttribute');
PHPGoodies::import('Lib.Dom.NameAttribute');
PHPGoodies::import('Lib.Dom.SchemeAttribute');

/**
 * MetaElement - META Element
 */
class MetaElement extends NodeElement {
	use CharSetAttribute, ContentAttribute, HttpEquivAttribute, NameAttribute, SchemeAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('meta', 'inline');
	}
}

