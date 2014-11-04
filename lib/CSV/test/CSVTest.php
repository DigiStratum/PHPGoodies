<?php
/**
 * PHPGoodies:CSV class test cases
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

class CSVTest extends \PHPUnit_Framework_TestCase {

	/**
	 * An instance of the class under test
	 */
	private $csv;

	/**
	 * Constructor
	 */
	public function __construct() {

		// Where is the source dir? (independent of CWD)
		PHPGoodies::import('lib.CSV.CSV');
	}

	/**
	 * Setup to occur ahead of each test method invocation
	 */
	public function setup() {
		$this->csv = new CSV();
	}

	/**
	 * Teardown to occur after each test method invocation
	 */
	public function teardown() {
		unset($this->csv);
	}

	/**
	 * That no data comes out of an empty string
	 */
	public function testThatWeGetNoElementsWhenEmpty() {
		$data = $this->csv->tokenize('');
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
			$data = $this->csv->tokenize($csv);
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
		$data = $this->csv->tokenize('a,,,z');
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
		$data = $this->csv->tokenize($csv);
		$this->assertEquals(4, count($data));
		$this->assertEquals('a', $data[0]);
		$this->assertEquals("'b'", $data[1]);
		$this->assertEquals('c', $data[2]);
		$this->assertEquals('z', $data[3]);

		// .. with a non-default delimiter..
		$data = $this->csv->tokenize($csv, "'");
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
		$data = $this->csv->tokenize('"a,b","c,z"');
		$this->assertEquals(2, count($data));
		$this->assertEquals('a,b', $data[0]);
		$this->assertEquals('c,z', $data[1]);
	}

	/**
	 * Test that quoted fields with escaped delimiters that appear inside them don't fool it
	 */
	public function testThatEscapedDelimitersInQuotedFieldsDontFoolIt() {
		$data = $this->csv->tokenize("'shouldn\\'t fail','c,z'", "'");
		$this->assertEquals(2, count($data));
		$this->assertEquals("shouldn't fail", $data[0]);
		$this->assertEquals('c,z', $data[1]);
	}
}
