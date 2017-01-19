<?php
/**
 * PHPGoodies:Lib_Net_Api_Rest_JsonApi_Server class test cases
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../../../PHPGoodies.php'));

class Lib_Net_Api_Rest_JsonApi_Server_Test extends \PHPUnit_Framework_TestCase {

	/**
	 * Constructor
	 */
	public function __construct() {
		PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server');
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
}

