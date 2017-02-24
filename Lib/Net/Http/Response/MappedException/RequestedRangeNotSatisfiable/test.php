<?php
/**
 * PHPGoodies:Lib_Net_Http_Response_MappedException_RequestedRangeNotSatisfiable_Test class test cases
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../../../../PHPGoodies.php'));

class Lib_Net_Http_Response_MappedException_RequestedRangeNotSatisfiable_Test extends \PHPUnit_Framework_TestCase {

	protected $class = 'Lib.Net.Http.Response.MappedException.RequestedRangeNotSatisfiable';
	protected $code = 416;

	/**
	 * Constructor
	 */
	public function __construct() {
		PHPGoodies::import($this->class);
		PHPGoodies::import('Lib.Net.Http.Response');
	}

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
	 * Test that the default mapped exception has the response code that we expect
	 */
	public function testThatTheMappedCodeIsWhatWeExpect() {
		$e = PHPGoodies::instantiate($this->class);
		$this->assertEquals($this->code, $e->getCode());
	}

	/**
	 * Test that default mapped exception has the message that we expect
	 */
	public function testThatDefaultMessageIsWhatWeExpect() {
		$e = PHPGoodies::instantiate($this->class);
		$expectedMsg = Lib_Net_Http_Response::getDescription($this->code);
		$this->assertEquals($expectedMsg, $e->getMessage());
	}

	/**
	 * Test that mapped exception has custom message
	 */
	public function testThatCustomMessageWorks() {
		$customMsg = 'Hallo!';
		$e = PHPGoodies::instantiate($this->class, $customMsg);
		$expectedMsg = Lib_Net_Http_Response::getDescription($this->code) . " - {$customMsg}";
		$this->assertEquals($expectedMsg, $e->getMessage());
	}

	/**
	 * Test that previous exception is preserved
	 */
	public function testThatPreviousThrowableIsPreserved() {
		$pe = new \Exception('Hallo!');
		$e = PHPGoodies::instantiate($this->class, null, $pe);
		$previous = $e->getPrevious();
		$this->assertEquals('Hallo!', $previous->getMessage());
	}
}

