<?php
/**
  * PHPGoodies:VideoElement - VIDEO Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

// Attributes
PHPGoodies::import('Lib.Dom.Attributes.AutoPlayAttribute');
PHPGoodies::import('Lib.Dom.Attributes.AutoBufferAttribute');
PHPGoodies::import('Lib.Dom.Attributes.BufferedAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ControlsAttribute');
PHPGoodies::import('Lib.Dom.Attributes.CrossOriginAttribute');
PHPGoodies::import('Lib.Dom.Attributes.HeightAttribute');
PHPGoodies::import('Lib.Dom.Attributes.LoopAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MutedAttribute');
PHPGoodies::import('Lib.Dom.Attributes.PlayedAttribute');
PHPGoodies::import('Lib.Dom.Attributes.PreloadAttribute');
PHPGoodies::import('Lib.Dom.Attributes.PosterAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SrcAttribute');
PHPGoodies::import('Lib.Dom.Attributes.WidthAttribute');


/**
 * VideoElement - VIDEO Element
 */
class VideoElement extends NodeElement {
	use AutoPlayAttribute, AutoBufferAttribute, BufferedAttribute, ControlsAttribute;
	use CrossOriginAttribute, HeightAttribute, LoopAttribute, MutedAttribute, PlayedAttribute;
	use PreloadAttribute, PosterAttribute, SrcAttribute, WidthAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('video', 'block');
	}
}

