<?php
/**
 * PHPGoodies HttpRequestExample.php
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

// 1) Adapt the name-spaced goodies to the global namespace
use PHPGoodies\PHPGoodies as PHPGoodies;
use PHPGoodies\HttpRequest as HttpRequest;
use PHPGoodies\HttpResponse as HttpResponse;
use PHPGoodies\RestEndpoint as RestEndpoint;

// 2) Load up our goodies
require(realpath(dirname(__FILE__) . '/../../../../../PHPGoodies.php'));
PHPGoodies::import('Lib.Net.Http.HttpRequest');
PHPGoodies::import('Lib.Net.Http.HttpResponse');
PHPGoodies::import('Lib.Net.Http.Rest.RestEndpoint');

// 3) Make a custom API endpoint
class ChronometricsEndpoint extends RestEndpoint {
	public function __construct() {

		// Set up an optional CORS policy for this endpoint
		$corsPolicy = PHPGoodies::instantiate('Lib.Net.Http.CorsPolicy', array(HttpRequest::HTTP_GET));
		$corsPolicy->addOrigin(HttpRequest::HTTP_GET, '*');
		$this->setCorsPolicy($corsPolicy);
	}

	// GET request handler
	public function get($httpRequest) {
		$response = PHPGoodies::instantiate('Lib.Net.Http.Rest.JsonResponse');
		$response->dto->setProperties(array(
			'currentTime' => date('Y-m-d h:m:s')
		));
		$response->code = HttpResponse::HTTP_OK;
		return $response;
	}
}
$api = PHPGoodies::instantiate('Lib.Net.Http.Rest.RestApi', '/api/2', 'General Api', 2);
$api->addEndpoint('/api/2/chronometrics', new ChronometricsEndpoint());

// 4) Now mock up an HTTP request to see how the endpoint responds
$_SERVER['REQUEST_SCHEME'] = 'http';
$_SERVER['HTTP_HOST'] = 'localhost';
$_SERVER['SERVER_PORT'] = 80;
$_SERVER['REQUEST_METHOD'] = HttpRequest::HTTP_GET;
$_SERVER['REQUEST_URI'] = '/api/2/chronometrics';
$_SERVER['REQUEST_HEADERS'] = array(
	'Origin' => 'http://www.phpgoodies.org/'
);

$httpResponse = $api->getResponse();
$api->respond($httpResponse);
print "\n\n" . $httpResponse->headers->see('Response Headers');

