<?php
/**
 * PHPGoodies:String class test cases
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

class StringTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Constructor
	 */
	public function __construct() {
		PHPGoodies::import('Lib.Data.String');
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
	 * Test that string reflects initialization
	 */
	public function testThatStringReflectsInitialization() {
		$values = array(
			'',
			'a',
			'apples and bananas',
			"this\nand\tthat\n\n"
		);

		foreach ($values as $val) {
			$str = PHPGoodies::instantiate('Lib.Data.String', $val);
			$this->assertEquals($val, $str->get());
		}
	}

	/**
	 * Test that the string length is what we expect it to be
	 */
	public function testThatStringLengthIsCorrect() {
		$values = array(
			'',
			'a',
			'apples and bananas',
			"this\nand\tthat\n\n"
		);

		foreach ($values as $val) {
			$str = PHPGoodies::instantiate('Lib.Data.String', $val);
			$this->assertEquals(strlen($val), $str->len());
		}
	}

	/**
	 * Test that equality checking works for identical strings
	 */
	public function testThatEqualityCheckingWorks() {
		$value = 'This is a string that should be equal to itself';
		$str1 = PHPGoodies::instantiate('Lib.Data.String', $value);
		$str2 = PHPGoodies::instantiate('Lib.Data.String', $value);

		// It should equal the raw value
		$this->assertTrue($str1->equals($value));
		// It should equal itself
		$this->assertTrue($str1->equals($str1));
		// It should equal the other string
		$this->assertTrue($str1->equals($str2));
	}

	/**
	 * Test that unequal strings come back as unequal...
	 */
	public function testThatUnequalStringsAreUnequal() {
		$value1 = 'apples';
		$str1 = PHPGoodies::instantiate('Lib.Data.String', $value1);
		$value2 = 'oranges';
		$str2 = PHPGoodies::instantiate('Lib.Data.String', $value2);

		// It should not equal the other raw value
		$this->assertFalse($str1->equals($value2));
		// It should not equal the other string
		$this->assertFalse($str1->equals($str2));
	}
}

