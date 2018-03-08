<?php
/**
 * PHPGoodies:Oauth2AuthUser class test cases
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../../../../PHPGoodies.php'));

PHPGoodies::import('Lib.Net.Http.Oauth2.Auth.User');
PHPGoodies::import('test.TestFramework.TestCase');

class Oauth2AuthUserTest extends test_TestFramework_TestCase {

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
	 * Test that a new AuthUser returns the basic data that it was constructed with
	 *
	 * FIXME: This should be using PHPGoodies::instantiate() instead of direct new()
	 */
	public function testThatNewAuthUserReturnsBasicData() {
		$authUser = new Lib_Net_Http_Oauth2_Auth_User('USERID', 'USERNAME');
		$data = $authUser->getData();

		$this->assertTrue(is_object($data));
		$this->assertEquals('USERID', $data->userId);
		$this->assertEquals('USERNAME', $data->userName);
		$this->assertTrue(is_array($data->authorizedScopes));
		$this->assertEquals(0, count($data->authorizedScopes));
	}

	/**
	 * Test that an extended auth user class returns extended data & scopes defined within it
	 */
	public function testThatExtendedAuthUserReturnsExtendedData() {
		$authUser = new Oauth2AuthUserExtended('USERID', 'USERNAME');
		$data = $authUser->getData();

		$this->assertTrue(is_object($data));
		$this->assertEquals('USERID', $data->userId);
		$this->assertEquals('USERNAME', $data->userName);
		$this->assertEquals('READALLABOUTIT!', $data->extraExtra);
		$this->assertTrue(is_array($data->authorizedScopes));
		$this->assertEquals(2, count($data->authorizedScopes));
		$this->assertEquals('scope1', $data->authorizedScopes[0]);
		$this->assertEquals('scope2', $data->authorizedScopes[1]);
	}
}

/**
 * Our own custom extension of the class under test
 */
class Oauth2AuthUserExtended extends Lib_Net_Http_Oauth2_Auth_User {
	public function __construct($userId, $userName) {
		parent::__construct($userId, $userName);
		$this->data->set('extraExtra', 'READALLABOUTIT!');
		$this->authorizeScope('scope1');
		$this->authorizeScope('scope2');
	}
}

