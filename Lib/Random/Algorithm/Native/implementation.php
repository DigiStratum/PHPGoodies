<?php
/**
 * PHPGoodies:Lib_Random_Algorithm_Native - Native PHP Random number generation algorithm
 *
 * @uses Lib_Random_Algorithm
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Random.Algorithm');

/**
 * Native PHP Random number generation algorithm
 */
class Lib_Random_Algorithm_Native implements Lib_Random_Algorithm {

	/**
	 * Constructor
	 */
	public function __construct() { }

	/**
	 * Seed the random algorithm with the supplied value
	 *
	 * @param mixed $seed A string or numeric value to seed with
	 */
	public function seed($seed) {
		srand($seed);
	}

	/**
	 * Get the next random number in sequence from this algorithm
	 *
	 * @return integer The next random number...
	 */
	public function rand() {
		return rand();
	}
}

