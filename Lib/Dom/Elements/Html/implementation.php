<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Html - HTML Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.ManifestAttribute');
PHPGoodies::import('Lib.Dom.Attributes.VersionAttribute');


/**
 * Html - HTML Element
 */
class Lib_Dom_Elements_Html extends Lib_Dom_Node_Element {
	use ManifestAttribute, VersionAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('html', 'block');
	}
}

