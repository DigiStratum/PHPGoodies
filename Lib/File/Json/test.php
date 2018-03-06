<?php
/**
 * PHPGoodies:Lib_File_Json class test cases
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

class Lib_File_Json_Test extends \PHPUnit_Framework_TestCase {

	protected $sut;

	/**
	 * Constructor
	 */
	public function __construct() {
		PHPGoodies::import('Lib.File.Json');
	}

	/**
	 * Setup to occur ahead of each test method invocation
	 */
	public function setup() {
		$this->sut = PHPGoodies::instantiate('Lib.File.Json');
	}

	/**
	 * Teardown to occur after each test method invocation
	 */
	public function teardown() {
	}

	public function testThatComposeJsonPassesThroughNull() {
		$res = $this->sut->composeJson(null);
		$this->assertNull($res);
	}
}

