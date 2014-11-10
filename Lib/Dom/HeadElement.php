<?php
/**
  * PHPGoodies:HeadElement - HEAD Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * HeadElement - HEAD Element
 */
class HeadElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('head', 'block');
	}

	/**
	 * Set the profile attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setProfile($value) {
		$this->setAttribute('profile', $value);

		return $this;
	}

	/**
	 * Get the profile attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getProfile() {
		return $this->getAttribute('profile');
	}
}

