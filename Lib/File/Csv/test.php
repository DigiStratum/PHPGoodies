<?php
/**
 * PHPGoodies:Lib_File_Csv class test cases
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));
PHPGoodies::import('test.TestFramework.TestCase');

class Lib_File_Csv_Test extends test_TestFramework_TestCase {

	/**
	 * Constructor
	 */
	public static function setupBeforeClass() {
		PHPGoodies::import('Lib.File.Csv');
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
	 * That no data comes out of an empty string
	 */
	public function testThatWeGetNoElementsWhenEmpty() {
		$data = Lib_File_Csv::tokenize('');
		$this->assertEquals(0, count($data));
	}

	/**
	 * Test that we get N+1 empty elements when we feed it just N comma's which represents N+1
	 * comma-separated empty strings
	 */
	public function testThatWeGetNPlus1EmptyElements() {
		$counts = array(2, 3, 7);
		foreach ($counts as $N) {
			$csv = str_repeat(',', $N-1);
			$data = Lib_File_Csv::tokenize($csv);
			$this->assertEquals($N, count($data));
			for ($x = 0; $x < $N; $x++) {
				$this->assertEquals('', $data[$x]);
			}
		}
	}

	/**
	 * Test that we get the first and last elements exactly as provided and nothing for the ones
	 * in between
	 */
	public function testThatWeGetFirstAndLastElementsExactly() {
		$data = Lib_File_Csv::tokenize('a,,,z');
		$this->assertEquals(4, count($data));
		$this->assertEquals('a', $data[0]);
		$this->assertEquals('', $data[1]);
		$this->assertEquals('', $data[2]);
		$this->assertEquals('z', $data[3]);
	}

	/**
	 * Test that the delimiter is handled correctly
	 */
	public function testThatMisquotesDontFoolIt() {
		$csv = "a,'b',\"c\",z";

		// .. with the default delimiter..
		$data = Lib_File_Csv::tokenize($csv);
		$this->assertEquals(4, count($data));
		$this->assertEquals('a', $data[0]);
		$this->assertEquals("'b'", $data[1]);
		$this->assertEquals('c', $data[2]);
		$this->assertEquals('z', $data[3]);

		// .. with a non-default delimiter..
		$data = Lib_File_Csv::tokenize($csv, "'");
		$this->assertEquals(4, count($data));
		$this->assertEquals('a', $data[0]);
		$this->assertEquals('b', $data[1]);
		$this->assertEquals('"c"', $data[2]);
		$this->assertEquals('z', $data[3]);
	}

	/**
	 * Test that quoted fields with separators that appear inside them don't fool it
	 */
	public function testThatSeparatorsInQuotedFieldsDontFoolIt() {
		$data = Lib_File_Csv::tokenize('"a,b","c,z"');
		$this->assertEquals(2, count($data));
		$this->assertEquals('a,b', $data[0]);
		$this->assertEquals('c,z', $data[1]);
	}

	/**
	 * Test that quoted fields with escaped delimiters that appear inside them don't fool it
	 */
	public function testThatEscapedDelimitersInQuotedFieldsDontFoolIt() {
		$data = Lib_File_Csv::tokenize("'shouldn\\'t fail','c,z'", "'");
		$this->assertEquals(2, count($data));
		$this->assertEquals("shouldn't fail", $data[0]);
		$this->assertEquals('c,z', $data[1]);
	}

	/**
	 * Test that passing an empty array to csvize() results in an empty string
	 */
	public function testThatAnEmptyArrayResultsInAnEmptyString() {
		$csv = Lib_File_Csv::csvize(array());
		$this->assertEquals('string', gettype($csv));
		$this->assertEquals(0, strlen($csv));
	}

	/**
	 * Test that passing a simple array to csvize() results in a properly encoded string
	 */
	public function testThatASimpleArrayIsEncodedProperly() {
		$csv = Lib_File_Csv::csvize(array(1,'2',3,'a,b,c'));
		$this->assertEquals('"1","2","3","a,b,c"', $csv);
	}

	/**
	 * Test that escaping of delimiter and escape characters is handled correctly
	 */
	public function testThatEscapingIsHandledCorrectly() {
		$str = "\"\\hello\\\"";
		$csv = Lib_File_Csv::csvize(array($str));
		// Crazy slashes: one escaped slash in the origrinal become DOUBLE escaped slashes!
		$this->assertEquals('"\"\\\\hello\\\\\""', $csv);
	}
}

