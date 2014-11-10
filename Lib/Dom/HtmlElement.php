<?php
/**
  * PHPGoodies:HtmlElement - HTML Element
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Lib.Dom.NodeElement');

/**
 * HtmlElement - HTML Element
 */
class HtmlElement extends NodeElement {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('html', 'block');
	}

	/**
	 * Set the manifest attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setManifest($value) {
		$this->setAttribute('manifest', $value);

		return $this;
	}

	/**
	 * Get the manifest attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getManifest() {
		return $this->getAttribute('manifest');
	}

	/**
	 * Set the version attribute value
	 *
	 * @param string $value The value to set for this attribute
	 *
	 * @return object This object for chaining...
	 */
	public function setVersion($value) {
		$this->setAttribute('version', $value);

		return $this;
	}

	/**
	 * Get the version attribute's current value
	 *
	 * @return string The attribute's current value or null if not set
	 */
	public function getVersion() {
		return $this->getAttribute('version');
	}
}

