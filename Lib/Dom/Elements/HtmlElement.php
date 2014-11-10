<?php
/**
  * PHPGoodies:HtmlElement - HTML Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.ManifestAttribute');
PHPGoodies::import('Lib.Dom.Attributes.VersionAttribute');


/**
 * HtmlElement - HTML Element
 */
class HtmlElement extends NodeElement {
	use ManifestAttribute, VersionAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('html', 'block');
	}
}

