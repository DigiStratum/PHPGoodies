<?php
/**
 * PHPGoodies:Random class test cases
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

class RandomTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Constructor
	 */
	public function __construct() {
		PHPGoodies::import('Lib.Random.Random');
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
	 * Test that random numbers are consistent within each supported algorithm
	 */
	public function testThatRandNumbersAreConsistent() {
		$secret = 'ThisIsTheTestSecret';
		$limit = 10000;
		for ($alg = 0; $alg <= 1; $alg++) {
			$prng = PHPGoodies::instantiate('Lib.Random.Random', $alg);

			// Fill up the set array with pseudorandom numbers
			$set = array();
			$distinct = array();
			$prng->seed($secret);
			for ($xx = 0; $xx < $limit; $xx++) {
				$set[$xx] = $val = $prng->rand();
				if (! isset($distinct[$val])) {
					$distinct[$val] = 1;
				}
				else $distinct[$val]++;
			}

			// Expect somewhere around 99-100% distinct values...
			$minDistinct = (integer) ($limit * 99 / 100);
			$this->assertTrue($minDistinct <= count($distinct));

			// Now re-seed and veryify that we can get the same sequence again
			$prng->seed($secret);
			for ($xx = 0; $xx < $limit; $xx++) {
				$this->assertEquals($set[$xx], $prng->rand());
			}
		}

	}
}
