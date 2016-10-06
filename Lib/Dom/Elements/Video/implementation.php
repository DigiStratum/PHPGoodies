<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Video - VIDEO Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.Node.Element');

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
 * Video - VIDEO Element
 */
class Lib_Dom_Elements_Video extends Lib_Dom_Node_Element {
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

