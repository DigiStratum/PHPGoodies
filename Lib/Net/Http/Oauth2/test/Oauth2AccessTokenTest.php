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
	 * Test that newly instantiated Oauth2AccessToken has no data in it
	 */
	public function testThatToTokenGeneratesTokenStringsForValidData() {
		$accessToken = PHPGoodies::instantiate('Lib.net.Http.Oauth2.Oauth2AccessToken', 'secret');

		$data = Array(
			'a' => 1,
			'b' => 2
		);
		$token = $accessToken->toToken($data);
print "token = '{$token}'\n";

		//$this->assertEquals(0, $hash->num());
		//$this->assertEquals(0, count($hash->keys()));
	}
}

