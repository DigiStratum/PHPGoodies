<?php
/**
 * PHPGoodies JSON:API Server Controller Example
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

// 1) Adapt the name-spaced goodies to the global namespace
use PHPGoodies\PHPGoodies as PHPGoodies;
use PHPGoodies\Lib_Net_Api_Rest_JsonApi_Server_Controller as Lib_Net_Api_Rest_JsonApi_Server_Controller;
use PHPGoodies\Lib_Net_Api_Rest_JsonApi_Server_Service as Lib_Net_Api_Rest_JsonApi_Server_Service;

// 2) Load up our goodies
require(realpath(dirname(__FILE__) . '/../../../../../../../PHPGoodies.php'));
PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.Controller');
PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.Service');
PHPGoodies::import('Lib.Net.Http.Request');

// 3) Provide an implementation for a Service
class MyService implements Lib_Net_Api_Rest_JsonApi_Server_Service {
	public function create($variables) {return true;}
        public function retrieve($variables) {return true;}
        public function update($variables) {return true;}
        public function delete($variables) {return true;}
        public function replace($variables) {return true;}
        public function getMetaData($variables) {return true;}
}

// 4) Provide an implementation for a Controller
class MyController extends Lib_Net_Api_Rest_JsonApi_Server_Controller {

	static protected $pattern = '/path/{#number}/dir/{$string}';

	public function __construct($service) {
		parent::__construct(self::getUriPattern(), $service);
	}

	static protected function getUriPattern() {
		return PHPGoodies::instantiate('Lib.Net.Api.Rest.JsonApi.Server.UriPattern', self::$pattern);
	}

	static public function matchesUri($uri) {
		$uriPattern = self::getUriPattern();
		return $uriPattern->matchesUri($uri);
	}
}


$uris = Array(
	'/path/number/dir/string',	// NO match
	'/path/333/dir/string'		// matches!
);

foreach ($uris as $uri) {
	if (MyController::matchesUri($uri)) {
		$myService = new MyService();
		$myController = new MyController($myService);

		// mock an HttpRequest
		$httpRequest = PHPGoodies::instantiate('Lib.Net.Http.Request', false);
		$httpRequest->setMethod('GET')->setScheme('https')->setHost('localhost')->setPath($uri);

		try {
			$httpResponse = $myController->getResponseForRequest($httpRequest);
			print "RESPONSE: \n" . print_r($httpResponse, true) . "\n\n";
		}
		catch (Exception $e) {
			print "Exception: [{$e->getMessage()}]\n\n";
		}
	}
}

