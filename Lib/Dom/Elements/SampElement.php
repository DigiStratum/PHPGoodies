<?php
/**
  * PHPGoodies:SampElement - SAMP Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * SampElement - SAMP Element
 */
class SampElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('samp', 'block');
	}
}
