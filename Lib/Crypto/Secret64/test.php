<?php
/**
 * PHPGoodies:Secret64 class test cases
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

class Secret64Test extends \PHPUnit\Framework\TestCase {

	/**
	 * Constructor
	 */
	public function __construct() {
		PHPGoodies::import('Lib.Crypto.Secret64');
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
	 * Test that the encoding is restricted to base64 character set
	 */
	public function testThatEncodingUsesBase64Charset() {
		$charset = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz+/=';
		$message = 'BE SURE TO DRINK YOUR OVALTINE';
		$secret64 = PHPGoodies::instantiate('Lib.Crypto.Secret64', 'goodsecret');
		$encoded = $secret64->encode($message);
		for ($xx = 0; $xx < strlen($encoded); $xx++) {
			$this->assertTrue(strpos($charset, $encoded{$xx}) !== false);
		}
		// TODO - verify ths with more than just a single encoded message?
	}

	/**
	 * Test that the encoding is NOT a simple base64 string
	 */
	public function testThatEncodingIsNotSimpylBase64() {
		$message = 'BE SURE TO DRINK YOUR OVALTINE';
		$secret64 = PHPGoodies::instantiate('Lib.Crypto.Secret64', 'goodsecret');
		$encoded = $secret64->encode($message);
		$base64 = base64_encode($message);

		$this->assertTrue($encoded != $base64);
	}

	/**
	 * Test that the encoding is reversible when the secret matches
	 */
	public function testThatEncodingIsReversibleWithMatchingSecret() {
		$secret64 = PHPGoodies::instantiate('Lib.Crypto.Secret64', 'goodsecret');
		$message = 'BE SURE TO DRINK YOUR OVALTINE';
		$encoded = $secret64->encode($message);
		$decoded = $secret64->decode($encoded);

		$this->assertEquals($message, $decoded);
	}

	/**
	 * test that the encoding is NOT reversible when the secret does NOT match
	 */
	public function testThatEncodingIsNotReversibleWithMismatchedSecret() {
		$secret64 = PHPGoodies::instantiate('Lib.Crypto.Secret64', 'goodsecret');
		$message = 'BE SURE TO DRINK YOUR OVALTINE';
		$encoded = $secret64->encode($message);

		$secret64 = PHPGoodies::instantiate('Lib.Crypto.Secret64', 'badsecret');
		$decoded = $secret64->decode($encoded);

		$this->assertTrue($message !== $decoded);
	}
}
