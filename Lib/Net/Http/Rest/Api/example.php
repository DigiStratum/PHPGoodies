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
PHPGoodies::import('Lib.Net.Http.Request');
PHPGoodies::import('Lib.Net.Http.Response');
PHPGoodies::import('Lib.Net.Http.Rest.Endpoint');

// 3) Make a custom API endpoint
class ChronometricsEndpoint extends Lib_Net_Http_Rest_Endpoint {
	public function __construct() {

		// Set up an optional CORS policy for this endpoint
		$corsPolicy = PHPGoodies::instantiate('Lib.Net.Http.CorsPolicy', array(HttpRequest::HTTP_GET));
		$corsPolicy->addOrigin(HttpRequest::HTTP_GET, '*');
		$corsPolicy->addOrigin(HttpRequest::HTTP_GET, 'http://www.phpgoodies.org/');
		$corsPolicy->addOrigin(HttpRequest::HTTP_GET, 'http://www.digistratum.com/');
		$corsPolicy->addHeader(HttpRequest::HTTP_GET, 'Custom-Request-Header');
		$corsPolicy->exposeHeader(HttpRequest::HTTP_GET, 'Custom-Response-Header');
		$corsPolicy->allowCredentials(HttpRequest::HTTP_GET);
		$this->setCorsPolicy($corsPolicy);
	}

	// GET request handler
	public function get($httpRequest) {
		$defaultResponse = parent::get($httpRequest);
		$response = PHPGoodies::instantiate('Lib.Net.Http.Rest.Response.Json');
		$response->headers->merge($defaultResponse->headers);
		$response->headers->set('Custom-Response-Header', 'ANOTHERVALUE');
		$response->dto->setProperties(array(
			'currentTime' => date('Y-m-d h:m:s')
		));
		$response->code = HttpResponse::HTTP_OK;
		return $response;
	}
}


// 4) Mock up an HTTP request to see how the endpoint responds

// Preflight (OPTIONS)
$_SERVER['REQUEST_SCHEME'] = 'http';
$_SERVER['HTTP_HOST'] = 'localhost';
$_SERVER['SERVER_PORT'] = 80;
$_SERVER['REQUEST_METHOD'] = HttpRequest::HTTP_OPTIONS;
$_SERVER['REQUEST_URI'] = '/api/2/chronometrics';
$_SERVER['REQUEST_HEADERS'] = array(
	'Access-Control-Request-Method' => 'GET',
	'Access-Control-Request-Headers' => 'Custom-Request-Header',
	'Origin' => 'http://www.phpgoodies.org/'
);

// 5) Set up the API with the request context in place
$api = PHPGoodies::instantiate('Lib.Net.Http.Rest.Api', '/api/2', 'General Api', 2);
$api->addEndpoint('/api/2/chronometrics', new ChronometricsEndpoint());

print "{$_SERVER['REQUEST_METHOD']}:\n";
$httpResponse = $api->getResponse();
$api->respond($httpResponse);
print "\n\n" . $httpResponse->headers->see('Response Headers');

// Then a GET
$_SERVER['REQUEST_METHOD'] = HttpRequest::HTTP_GET;
$_SERVER['REQUEST_HEADERS'] = array(
	'Custom-Request-Header' => 'CUSTOMVALUE',
	'Origin' => 'http://www.phpgoodies.org/'
);

print "{$_SERVER['REQUEST_METHOD']}:\n";
$httpResponse = $api->getResponse();
$api->respond($httpResponse);
print "\n\n" . $httpResponse->headers->see('Response Headers');

// Then a GET ... with Cookie
$_SERVER['REQUEST_HEADERS'] = array(
	'Origin' => 'http://www.phpgoodies.org/',
	'Cookie' => 'customcookie=whatever'
);

print "{$_SERVER['REQUEST_METHOD']}:\n";
$httpResponse = $api->getResponse();
$api->respond($httpResponse);
print "\n\n" . $httpResponse->headers->see('Response Headers');

// Then a GET ... with Authorization
$_SERVER['REQUEST_HEADERS'] = array(
	'Origin' => 'http://www.phpgoodies.org/',
	'Authorization' => 'Basic qf3c9m849m84m94c8jf4cq9cmfwqj'
);

print "{$_SERVER['REQUEST_METHOD']}:\n";
$httpResponse = $api->getResponse();
$api->respond($httpResponse);
print "\n\n" . $httpResponse->headers->see('Response Headers');

