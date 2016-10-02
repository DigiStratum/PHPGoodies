<?php
/**
 * PHPGoodies:RandomAlgorithmNative - Native PHP Random number generation algorithm
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Random.RandomAlgorithmIfc');

/**
 * Native PHP Random number generation algorithm
 */
class RandomAlgorithmNative implements RandomAlgorithmIfc {

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

