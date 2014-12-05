<?php
/**
 * PHPGoodies:Secret64 - A secret-ciphered layer for Base64
 *
 * Bas64 encoding is a convenient way to glob up nearly any data you want into a string that is
 * neatly ASCII encoded in order to ensure data integrity when in transit across a wide variety
 * of networking and software systems such that the data has a much stronger chance of coming out
 * the other end in the same condition that it went in.
 *
 * The problem is that Bas64 does not offer any means of protecting what is encoded within; even
 * though it is impossible to read at first glance, it is a simple matter to run the text through
 * a decoder and get the original content out of it without any challenge. Base64 encoded strings
 * are relatively easy to spot when they are in use and for a hacker/developer make for a pretty
 * straightforward target to automatically decode when they are spotted.
 *
 * The solution is to impose an additional layer of encoding on top of Base64. One could always, of
 * course, use strong encryption on the data going in, but this can be complex to set up, and may be
 * overkill depending on the application. For example if there is some secret personal or otherwise
 * sensitive information being transmitted, then strong encryption is called for. Put if you just
 * want to obfuscate some information in such a way as to increase the level of difficulty of a
 * direct attack on your system then a simple cipher layer is a fast, effective means of handling
 * that.
 *
 * Herein lies just such a solution. The idea is to leverage the same character set that Base64 uses
 * to enjoy the same benefits of data integrity in transit, but scramble the characters according to
 * some secret such that the receiver using the same secret/code would be able to unscramble the
 * base64 data and decode normally.
 *
 * Note that due to this implementation's reliance on random number generation and the differences
 * in random number generation from platform to platform, messages encoded by thie class can only be
 * decoded by this same class. The code may run on two different computers, but it would not be
 * possible to, say, reimplement this code in JavaScript and have the JS encode and this PHP decode.
 * ... Not without making a cross-platform consistent pseudo random number generator algorithm, that
 * is...
 * 
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Secret64
 */
class Secret64 {

	/**
	 * Our cipher map
	 */
	protected $map;

	/**
	 * Constructor
	 *
	 * @param integer $seed Seed the random number generator with this to make our unique map
	 */
	public function __construct($seed) {
		$map = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz+/=';

		// Scramble the sequencing
		srand($seed);
		$max = strlen($map) - 1;
		for ($xx = 0; $xx < strlen($map); $xx++) {

			// Encode
			$pick = rand(0, $max);
			if ($pick == $xx) continue;
			$tmp = $map{$xx};
			$map{$xx} = $map{$pick};
			$map{$pick} = $tmp;
		}
		
		$this->map = $map;
	}

	/**
	 * Encode the supplied string
	 *
	 * @param string $str Any string that we want to encode
	 *
	 * @return string Ciphered string encoded with the secret in bsae64 charset
	 */
	public function encode($str) {
		return $this->b64Cipher(base64_encode($str));
	}

	/**
	 * Decode the encoded string
	 *
	 * @param string $str A string encoded by encode() with the SAME secret as we have
	 *
	 * @return string Original, unencoded string if the secret matches, or garbage if not
	 */
	public function decode($str) {
		return base64_decode($this->b64Cipher($str));
	}

	/**
	 * cipher the supplied string
	 *
	 * The cipher applied twice to a string will return the original string, so it doesn't
	 * matter whether we are encoding or decoding at this layer.
	 *
	 * @param string $str A string using the base64 character set
	 *
	 * @return string A string transformed by the cipher map in the same character set
	 */
	protected function b64Cipher($str) {
		$max = strlen($this->map) - 1;
		$inverted = '';
		for ($xx = 0; $xx < strlen($str); $xx++) {
			$chr = $str{$xx};
			$pos = strpos($this->map, $chr);
			$inv = $max - $pos;
			$inverted .= $this->map{$inv};
		}
		return $inverted;
	}
}

