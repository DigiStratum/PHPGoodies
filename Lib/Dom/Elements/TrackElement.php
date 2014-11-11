<?php
/**
  * PHPGoodies:TrackElement - TRACK Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.DefaultAttribute');
PHPGoodies::import('Lib.Dom.Attributes.KindAttribute');
PHPGoodies::import('Lib.Dom.Attributes.LabelAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SrcAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SrcLangAttribute');

/**
 * TrackElement - TRACK Element
 */
class TrackElement extends NodeElement {
	use DefaultAttribute, KindAttribute, LabelAttribute, SrcAttribute, SrcLangAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('track', 'block');
	}
}

