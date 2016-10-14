<?php
/**
 * PHPGoodies:Mustache class test cases
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

class MustacheTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Our class under test
	 */
	private $class;

	/**
	 * Constructor
	 */
	public function __construct() {
		PHPGoodies::import('Lib.Template.Mustache');
	}

	/**
	 * Setup to occur ahead of each test method invocation
	 */
	public function setup() {
		$this->class = PHPGoodies::instantiate('Lib.Template.Mustache');
	}

	/**
	 * Teardown to occur after each test method invocation
	 */
	public function teardown() {
		unset($this->class);
	}

	/**
	 * Test that an empty template renders an empty result
	 */
	public function testRenderEmptyTemplateEmptyResult() {
		$template = '';
		$data = new \stdClass();
		$res = $this->class->render($template, $data);
		$this->assertEquals('', $res);
	}
}

