<?php
/**
 * PHPGoodies:Lib_Data_String class test cases
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

class Lib_Data_String_Test extends \PHPUnit_Framework_TestCase {

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

		$ok = true;
		foreach ($values as $val) {
			$str = PHPGoodies::instantiate('Lib.Data.String', $val);
			if ($val !== $str->get()) {
				$ok = false;
				break;
			}
		}
		$this->assertTrue($ok);
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

		$ok = true;
		foreach ($values as $val) {
			$str = PHPGoodies::instantiate('Lib.Data.String', $val);
			if (strlen($val) !== $str->len()) {
				$ok = false;
				break;
			}
		}
		$this->assertTrue($ok);
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

	/**
	 * Test that bad sizes (like 0, -1) are ignored by getChunked()
	 */
	public function testThatGetChunkedIgnoresBadSizes() {
		$str = PHPGoodies::instantiate('Lib.Data.String', '');
		$res = $str->getChunked(0);
		$this->assertTrue(is_array($res));
		$this->assertEquals(0, count($res));
		$res = $str->getChunked(-1);
		$this->assertTrue(is_array($res));
		$this->assertEquals(0, count($res));
	}

	/**
	 * Test that good chunks are returned by getChunked() thousands of permutations considered!
	 */
	public function testThatGetChunkedDeliversGoodChunks() {
		// A string of 0 to 8 chars will be tested
		$source = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456879';

		// Let chunkSize range from 1 to the entire source string length...
		$ok = true;
		for ($chunkSize = 1; $chunkSize < strlen($source); $chunkSize++) {

			// Let the source string we're working with range from 0 to the entire source string length
			for ($sourceLen = 0; $sourceLen <= strlen($source); $sourceLen++) {
				$expectedChunks = ((integer) ($sourceLen / $chunkSize)) + ((($sourceLen % $chunkSize) > 0) ? 1 : 0);
				$val = substr($source, 0, $sourceLen);
				$str = PHPGoodies::instantiate('Lib.Data.String', $val);
				$res = $str->getChunked($chunkSize);

				if ((! is_array($res)) || ($expectedChunks != count($res))) {
					$ok = false;
					break(2);
				}

				for ($chunk = 0; $chunk < count($res); $chunk++) {
					$pos = $chunk * $chunkSize;
					$remaining = $sourceLen - $pos;
					$expectedChunkLength = ($remaining >= $chunkSize) ? $chunkSize : $remaining;

					if (($expectedChunkLength != strlen($res[$chunk])) || (substr($val, $pos, $expectedChunkLength) != $res[$chunk])) {
						$ok = false;
						break(2);
					}
				}
			}
		}

		$this->assertTrue($ok);
	}
}

