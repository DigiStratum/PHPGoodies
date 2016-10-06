<?php
/**
 * PHPGoodies:Lib_Random_Algorithm_Isaac - ISAAC Random number generation algorithm
 *
 * ISAAC random number generator by Bob Jenkins.  Initial PHP port by Ilmari Karonen, corrections
 * and adaptation to PHPGoodies by Sean M. Kelly.
 *
 * Based on the randport.c and readable.c reference C implementations by Bob Jenkins, with some
 * inspiration taken from the Perl port by John L. Allen.
 *
 * Bob's original C version was public domain; PHPGoodies PHP adaptation is MIT license along with
 * everything else to keep matters simple.
 *
 * ref: http://stackoverflow.com/questions/14420754/isaac-cipher-in-php
 * ref: http://en.wikipedia.org/wiki/ISAAC_%28cipher%29
 * ref: http://burtleburtle.net/bob/c/readable.c
 *
 * @uses Lib_Random_Algorithm
 *
 * @author Bob Jenkins
 * @author Ilmari Karonen
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Random.Algorithm');

/**
 * ISAAC Random number generation algorithm
 */
class Lib_Random_Algorithm_Isaac implements Lib_Random_Algorithm {

	/**
	 * Internal state
	 */
	protected $m, $a, $b, $c;

	/**
	 * Current chunk of results
	 */
	protected $r = array();

	/**
	 * Constructor
	 */
	public function __construct() {

		// Some default data to start with (always the same) in case nobody seeds us
		$this->a = $this->b = $this->c = 0;
		$this->m = array_fill(0, 256, 0);
		$m =& $this->m;

		$a = $b = $c = $d = $e = $f = $g = $h = 0x9e3779b9;  // golden ratio

		// scramble it
		for ($i = 0; $i < 4; ++$i) {
			$this->mix($a, $b, $c, $d, $e, $f, $g, $h);
		}

		// fill in $m with messy stuff (does anyone really use this?)
		for ($i = 0; $i < 256; $i += 8) {
			$this->mix($a, $b, $c, $d, $e, $f, $g, $h);
			$m[$i  ] = $a; $m[$i+1] = $b; $m[$i+2] = $c; $m[$i+3] = $d;
			$m[$i+4] = $e; $m[$i+5] = $f; $m[$i+6] = $g; $m[$i+7] = $h;
		}

		// fill in the first set of results
		$this->isaac();
	}

	/**
	 * Seed the random algorithm with the supplied value
	 *
	 * @param mixed $seed A string or numeric value to seed with
	 */
	public function seed($seed) {
		$this->a = $this->b = $this->c = 0;
		$this->m = array_fill(0, 256, 0);
		$m =& $this->m;

		$a = $b = $c = $d = $e = $f = $g = $h = 0x9e3779b9;  // golden ratio

		// scramble it
		for ($i = 0; $i < 4; ++$i) {
			$this->mix($a, $b, $c, $d, $e, $f, $g, $h);
		}

		if (is_string($seed)) {
			// emulate casting char* to int* on a little-endian CPU
			$seed = array_values(unpack("V256", pack("a1024", $seed)));
		}

		// initialize using the contents of $seed as the seed
		for ($i = 0; $i < 256; $i += 8) {
			$a += $seed[$i	]; $b += $seed[$i+1];
			$c += $seed[$i+2]; $d += $seed[$i+3];
			$e += $seed[$i+4]; $f += $seed[$i+5];
			$g += $seed[$i+6]; $h += $seed[$i+7];
			$this->mix($a, $b, $c, $d, $e, $f, $g, $h);
			$m[$i  ] = $a; $m[$i+1] = $b; $m[$i+2] = $c; $m[$i+3] = $d;
			$m[$i+4] = $e; $m[$i+5] = $f; $m[$i+6] = $g; $m[$i+7] = $h;
		}

		// do a second pass to make all of the seed affect all of $m
		for ($i = 0; $i < 256; $i += 8) {
			$a += $m[$i  ]; $b += $m[$i+1]; $c += $m[$i+2]; $d += $m[$i+3];
			$e += $m[$i+4]; $f += $m[$i+5]; $g += $m[$i+6]; $h += $m[$i+7];
			$this->mix($a, $b, $c, $d, $e, $f, $g, $h);
			$m[$i  ] = $a; $m[$i+1] = $b; $m[$i+2] = $c; $m[$i+3] = $d;
			$m[$i+4] = $e; $m[$i+5] = $f; $m[$i+6] = $g; $m[$i+7] = $h;
		}

		// fill in the first set of results
		$this->isaac();
	}

	/**
	 * Get the next random number in sequence from this algorithm
	 *
	 * @return integer The next random number...
	 */
	public function rand() {
		if (empty($this->r)) $this->isaac();
		return array_pop($this->r);
	}

	/**
	 * Fills up the next block of 256 random numbers
	 */
	protected function isaac() {
		$c = ++$this->c;	// c gets incremented once per 256 results
		$b = $this->b += $c;	// then combined with b
		$a = $this->a;

		$m =& $this->m;
		$r =& $this->r;

		for ($i = 0; $i < 256; ++$i) {
			$x = $m[$i];
			switch ($i & 3) {
				case 0: $a ^= ($a << 13); break;
				case 1: $a ^= ($a >>  6) & 0x03ffffff; break;
				case 2: $a ^= ($a <<  2); break;
				case 3: $a ^= ($a >> 16) & 0x0000ffff; break;
			}
			$a += $m[$i ^ 128]; $a &= 0xffffffff;
			$m[$i] = $y = ($m[($x >>  2) & 255] + $a + $b) & 0xffffffff;
			$r[$i] = $b = ($m[($y >> 10) & 255] + $x) & 0xffffffff;
		}

		$this->a = $a;
		$this->b = $b;
		$this->c = $c;
	}

	/**
	 * Bit-swapping mixer-upper
	 *
	 * Part of the magic of the Isaac algorithm; values are passed by reference so that they may
	 * be modified directly. This lets us reuse this code in multiple places as if it were
	 * included directly at each spot.
	 *
	 * @param integer $a 1 of 8 integers to cross-fertilize bits amongst
	 * @param integer $b 2 of 8 integers to cross-fertilize bits amongst
	 * @param integer $c 3 of 8 integers to cross-fertilize bits amongst
	 * @param integer $d 4 of 8 integers to cross-fertilize bits amongst
	 * @param integer $e 5 of 8 integers to cross-fertilize bits amongst
	 * @param integer $f 6 of 8 integers to cross-fertilize bits amongst
	 * @param integer $g 7 of 8 integers to cross-fertilize bits amongst
	 * @param integer $h 8 of 8 integers to cross-fertilize bits amongst
	 */
	protected function mix( &$a, &$b, &$c, &$d, &$e, &$f, &$g, &$h ) {
		$a ^= ($b << 11);			   $d += $a; $b += $c;
		$b ^= ($c >>  2) & 0x3fffffff; $e += $b; $c += $d;
		$c ^= ($d <<  8);			   $f += $c; $d += $e;
		$d ^= ($e >> 16) & 0x0000ffff; $g += $d; $e += $f;
		$e ^= ($f << 10);			   $h += $e; $f += $g;
		$f ^= ($g >>  4) & 0x0fffffff; $a += $f; $g += $h;
		$g ^= ($h <<  8);			   $b += $g; $h += $a;
		$h ^= ($a >>  9) & 0x007fffff; $c += $h; $a += $b;
		// 64-bit PHP does something weird on integer overflow; avoid it
		$a &= 0xffffffff; $b &= 0xffffffff; $c &= 0xffffffff; $d &= 0xffffffff;
		$e &= 0xffffffff; $f &= 0xffffffff; $g &= 0xffffffff; $h &= 0xffffffff;
	}
}

