<?php
/**
 * PHPGoodies:Lib_Net_Http_Oauth2_AccessToken class test cases
 *
 * @uses Lib_Data_Hash
 * @uses Lib_Net_Http_Oauth2_AccessToken
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../../../PHPGoodies.php'));

class Lib_Net_Httpd_Oauth2_AccessToken_Test extends \PHPUnit_Framework_TestCase {

	/**
	 * Constructor
	 */
	public function __construct() {
		PHPGoodies::import('Lib.Net.Http.Oauth2.AccessToken');
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
		$hash = PHPGoodies::instantiate('Lib.Data.Hash');
		$createToken = PHPGoodies::instantiate('Lib.Net.Http.Oauth2.AccessToken', 'secret');
		$token = $createToken->dataToToken($hash);

		$this->assertTrue(strlen($token) > 0);
	}

	/**
	 * Test that toToken generates different token strings for different secrets
	 */
	public function testThatToTokenGeneratesDifferentTokenStringsForDifferentSecrets() {

		// Our sample data set...
		$hash = PHPGoodies::instantiate('Lib.Data.Hash');
		$hash->set('a', 1);
		$hash->set('b', 2);
		$hash->set('c', 3);

		$createToken1 = PHPGoodies::instantiate('Lib.Net.Http.Oauth2.AccessToken', 'secret1');
		$token1 = $createToken1->dataToToken($hash);

		$createToken2 = PHPGoodies::instantiate('Lib.Net.Http.Oauth2.AccessToken', 'secret2');
		$token2 = $createToken2->dataToToken($hash);

		$this->assertTrue($token1 != $token2);
	}

	/**
	 * Test that generated tokens decode again into the expected data
	 */
	public function testThatGeneratedTokenDecodesIntoExpectedData() {

		// Our sample data set...
		$hash = PHPGoodies::instantiate('Lib.Data.Hash');
		$hash->set('a', 1);
		$hash->set('b', 2);
		$hash->set('c', 3);

		$createToken = PHPGoodies::instantiate('Lib.Net.Http.Oauth2.AccessToken', 'secret');
		$token = $createToken->dataToToken($hash);

		$readToken = PHPGoodies::instantiate('Lib.Net.Http.Oauth2.AccessToken', 'secret');
		$data = $readToken->tokenToData($token);

		$this->assertTrue($data instanceof Lib_Data_Hash);
		$this->assertEquals(3, $data->num());
		$this->assertTrue($data->has('a'));
		$this->assertEquals(1, $data->get('a'));
		$this->assertTrue($data->has('b'));
		$this->assertEquals(2, $data->get('b'));
		$this->assertTrue($data->has('c'));
		$this->assertEquals(3, $data->get('c'));
	}
}

