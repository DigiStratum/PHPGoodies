<?php
/**
 * PHPGoodies:Oauth2AccessToken class test cases
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../../../PHPGoodies.php'));

class Oauth2AccessTokenTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Constructor
	 */
	public function __construct() {
		PHPGoodies::import('Lib.Net.Http.Oauth2.Oauth2AccessToken');
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
	 * Test that toToken generates valid token strings for valid data
	 */
	public function testThatToTokenGeneratesTokenStringsForValidData() {
		$createToken = PHPGoodies::instantiate('Lib.net.Http.Oauth2.Oauth2AccessToken', 'secret');
		$token = $createToken->toToken();

		$this->assertTrue(strlen($token) > 0);
	}

	/**
	 * Test that toToken generates different token strings for different secrets
	 */
	public function testThatToTokenGeneratesDifferentTokenStringsForDifferentSecrets() {
		$createToken1 = PHPGoodies::instantiate('Lib.net.Http.Oauth2.Oauth2AccessToken', 'secret1');
		$createToken1->set('a', 1);
		$createToken1->set('b', 2);
		$createToken1->set('c', 3);
		$token1 = $createToken1->toToken();

		$createToken2 = PHPGoodies::instantiate('Lib.net.Http.Oauth2.Oauth2AccessToken', 'secret2');
		$createToken2->set('a', 1);
		$createToken2->set('b', 2);
		$createToken2->set('c', 3);
		$token2 = $createToken2->toToken();

		$this->assertTrue($token1 != $token2);
	}

	/**
	 * Test that generated tokens decode again into the expected data
	 */
	public function testThatGeneratedTokenDecodesIntoExpectedData() {
		$createToken = PHPGoodies::instantiate('Lib.net.Http.Oauth2.Oauth2AccessToken', 'secret');
		$createToken->set('a', 1);
		$createToken->set('b', 2);
		$createToken->set('c', 3);
		$token = $createToken->toToken();

		$readToken = PHPGoodies::instantiate('Lib.net.Http.Oauth2.Oauth2AccessToken', 'secret');
		$readToken->fromToken($token);
		$data = $readToken->all();

		$this->assertTrue(is_array($data));
		$this->assertEquals(3, count($data));
		$this->assertTrue(isset($data['a']));
		$this->assertEquals(1, $data['a']);
		$this->assertTrue(isset($data['b']));
		$this->assertEquals(2, $data['b']);
		$this->assertTrue(isset($data['c']));
		$this->assertEquals(3, $data['c']);
	}
}

