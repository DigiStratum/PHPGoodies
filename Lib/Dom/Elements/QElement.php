<?php
/**
  * PHPGoodies:QElement - Q Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.CiteAttribute');

/**
 * QElement - Q Element
 */
class QElement extends NodeElement {
	use CiteAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('q', 'block');
	}
}

