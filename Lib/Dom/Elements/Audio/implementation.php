<?php
/**
  * PHPGoodies:Lib_Dom_Elements_Audio - AUDIO Element
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
PHPGoodies::import('Lib.Dom.Attributes.LoopAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MozCurrentSampleOffsetAttribute');
PHPGoodies::import('Lib.Dom.Attributes.MutedAttribute');
PHPGoodies::import('Lib.Dom.Attributes.PlayedAttribute');
PHPGoodies::import('Lib.Dom.Attributes.PreloadAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SrcAttribute');
PHPGoodies::import('Lib.Dom.Attributes.VolumeAttribute');

/**
 * Audio - AUDIO Element
 */
class Lib_Dom_Elements_Audio extends Lib_Dom_Node_Element {
	use AutoPlayAttribute, AutoBufferAttribute, BufferedAttribute, ControlsAttribute;
	use LoopAttribute, MozCurrentSampleOffsetAttribute, MutedAttribute, PlayedAttribute;
	use PreloadAttribute, SrcAttribute, VolumeAttribute;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('audio', 'block');
	}
}

