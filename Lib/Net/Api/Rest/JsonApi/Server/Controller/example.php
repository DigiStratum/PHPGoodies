<?php
/**
 * PHPGoodies StringCollectionExample.php
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

// 1) Adapt the name-spaced goodies to the global namespace
use PHPGoodies\PHPGoodies as PHPGoodies;
use PHPGoodies\Lib_Net_Api_Rest_JsonApi_Server_Controller as Controller;
use PHPGoodies\Lib_Net_Api_Rest_JsonApi_Server_Service as Service;

// 2) Load up our goodies
require(realpath(dirname(__FILE__) . '/../../../../../../../PHPGoodies.php'));
PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.Controller');

// 3) Provide an implementation for a Service
class MyService implements Service {
	public function create($variables) {return true;}
        public function retrieve($variables) {return true;}
        public function update($variables) {return true;}
        public function delete($variables) {return true;}
        public function replace($variables) {return true;}
        public function getMetaData($variables) {return true;}
}

// 4) Provide an implementation for a Controller
class MyController extends Controller {

	public function __construct($service) {
		parent::__construct(self::getUriPattern(), $service);
	}

	static private function getUriPattern() {
		return PHPGoodies::instantiate('Lib.Net.Api.Rest.JsonApi.Server.UriPattern', '/path/{#number}/dir/{$string}');
	}

	static public function matchesUri($uri) {
		$uriPattern = self::getUriPattern();
		return $uriPattern->matchesUri($uri);
	}
}


$collection = PHPGoodies::instantiate('Lib.Data.Collection', 'String');

$uris = Array(
	'/path/number/dir/string',
	'/path/333/dir/string'
);

foreach ($uris as $uri) {
	if (MyController::matchesUri($uri)) {
		$myService = new MyService();
		$myController = new MyController($myService);
	}
}

