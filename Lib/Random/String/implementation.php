<?php
/**
 * PHPGoodies:Lib_Random_String - A class generate random strings
 *
 * ref: https://paragonie.com/blog/2015/07/how-safely-generate-random-strings-and-integers-in-php
 *
 * @todo: Make this cryptographically secure with a better random number generation technique
 *
 * @uses Lib_Random
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Lib_Random_String - A class to generate random strings
 */
abstract class Lib_Random_String {

	/**
	 * Get a random string of characters based on the supplied charset
	 *
	 * WARNING: This is only as cryptographically secure as the random number generator used.
	 *
	 * Note: Charset may specify individual characters or ranges with left and right chars of
	 * the range separated by a '-'; these are expanded into the full set of characters between
	 * the left and the right, inclusively. If '-' itself is desired to be part of the charset,
	 * then it must appear either at the beginning or and of the charset specification where it
	 * is not situated between two other chars.
	 *
	 * @param integer $length number of characters that we want for our resulting string
	 * @param string $charset Optional charset string (has alphanumeric full set as default)
	 *
	 * @return string of random characters of the specified length
	 */
	static public function get($length, $charset = 'A-Za-z0-9') {
		$chars = Array();

		// Expand the charset string ranges (e.g. A-D becomes ABCD)
		if (preg_match_all('/(.-.)/', $charset, $matches)) {
			for ($mx = 0; $mx < count($matches[0]); $mx++) {
				$match = $matches[0][$mx];
				$firstOrd = ord($match{0});
				$lastOrd = ord($match{2});
				if ($firstOrd > $lastOrd) {
					$t = $firstOrd;
					$firstOrd = $lastOrd;
					$lastOrd = $t;
				}
				$expansion = '';
				for ($ch = $firstOrd; $ch <= $lastOrd; $ch++) {
					$expansion .= chr($ch);
				}
				$charset = str_replace($match, $expansion, $charset);
			}
		}

		$gen = '';
		$rand = PHPGoodies::instantiate('Lib.Random');
		$max = strlen($charset) - 1;
		for ($pos = 0; $pos < $length; $pos++) {
			$r = $rand->rand($max);
			$gen .= $charset{$r};
		}

		return $gen;
	}
}

