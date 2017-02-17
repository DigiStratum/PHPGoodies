<?php
/**
 * PHPGoodies:Lib_Net_Api_Rest_JsonApi_Server_Uri_Pattern class test cases
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../../../../../../PHPGoodies.php'));

class Lib_Net_Api_Rest_JsonApi_Server_Uri_Pattern_Test extends \PHPUnit_Framework_TestCase {

	/**
	 * Constructor
	 */
	public function __construct() { }

	/**
	 * Setup to occur ahead of each test method invocation
	 */
	public function setup() {
	}

	/**
	 * Teardown to occur after each test method invocation
	 */
	public function teardown() {
	}

	/**
	 * Test that basic numeric and string patterns generate expected regex
	 */
	public function testNumericStringPatternGeneratesExpectedRegex() {
		$pattern = PHPGoodies::instantiate('Lib.Net.Api.Rest.JsonApi.Server.Uri.Pattern', '/path/{#number}/dir/{$string}');
		$this->assertEquals('/^\/path\/(\d+)\/dir\/(\s+)$/', $pattern->toRegex());
	}
}

