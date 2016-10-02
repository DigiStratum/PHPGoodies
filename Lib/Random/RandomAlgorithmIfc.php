<?php
/**
 * PHPGoodies:RandomAlgorithm - Random Algorithm interface
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Random Algorithm interface
 */
interface RandomAlgorithmIfc {

	/**
	 * Seed the random algorithm with the supplied value
	 *
	 * The algorithm should require seed to either be a number or a string; here we see PHP's
	 * weakness with its lack of support for formal polymorphism.
	 *
	 * @param mixed $seed A string or numeric value to seed with
	 */
	public function seed($seed);

	/**
	 * Get the next random number in sequence from this algorithm
	 *
	 * @return integer The next random number...
	 */
	public function rand();
}

