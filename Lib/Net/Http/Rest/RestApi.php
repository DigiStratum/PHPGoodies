<?php
/**
 * PHPGoodies:RestApi - RESTful API shell
 *
 * @uses RestEndpoint
 * @uses RequestInfo
 * @uses HttpResponse
 * @uses JsonResponse
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Net.Http.RestEndpoint');
PHPGoodies::import('Lib.Net.Http.HttpResponse');

/**
 * RESTful API shell
 */
class RestApi {

	/**
	 * API signature string which will be in the default response
	 */
	protected $signature;

	/**
	 * API version indicator to make it easy for the caller to tell who they're talking to
	 */
	protected $version;

	/**
	 * The set of RestEndpoints that we are hosting
	 */
	protected $endpoints = array();

	/**
	 * The base URI for this API all others are relative to
	 */
	protected $baseUri;

	/**
	 * The protocol used to make the request
	 */
	protected $requestProtocol;

	/**
	 * Constructor
	 *
	 * @param string $baseUri The base URI for this API all others are relative to
	 * @param string $signature API signature string which will be in the default response
	 */
	public function __construct($baseUri, $signature = 'REST API', $version = 1) {
		$this->baseUri = $baseUri;
		$this->signature = $signature;
		$this->version = $version;
	}

	/**
	 * Add an API endpoint
	 *
	 * @param string $uri The URI that will invoke this RestEndpoint's handlers
	 * @param object RestEndpoint handler for this URI
	 *
	 * @return object $this for chaining support...
	 */
	public function addEndpoint($uri, &$restEndpoint) {
		if (! $restEndpoint instanceof RestEndpoint) {
			throw new \Exception('Something other than a RestEndpoint was supplied');
		}
		$this->endpoints[$uri] =& $restEndpoint;
		return $this;
	}

	/**
	 * Get the response that the API RestEndpoint would be to the current request
	 *
	 * @return object An instance of HttpResponse (or a subclass) with all the details inside
	 */
	public function getResponse() {
		$requestInfo = PHPGoodies::instantiate('Lib.Net.Http.RequestInfo');
		$requestInfo->initCurrentRequest();
		$request = $requestInfo->getInfo();

		$this->requestProtocol = $request['protocol'];

		if ($request['uri'] == $this->baseUri) {
			return $this->signatureResponse();
		}
		else if (! isset($this->endpoints[$request['uri']])) {
			return $this->errorResponse('Not Found', HttpResponse::HTTP_NOT_FOUND);
		}

		$restMethod = strtolower($request['method']);
		$restEndpoint =& $this->endpoints[$request['uri']];

		if (! $restEndpoint->isImplemented($restMethod)) {
			return $this->errorResponse('Method Not Allowed', HttpResponse::HTTP_METHOD_NOT_ALLOWED);
		}

		return $restEndpoint->$restMethod($requestInfo);
	}

	/**
	 * Actually send the response out to the client, headers, code, body, and all
	 */
	public function respond($httpResponse) {
		if (! $httpResponse instanceof HttpResponse) {
			throw new \Exception('Something other than an HttpResponse was supplied');
		}
		// Add a header for the HTTP/S response
		$httpResponse->headers->set($this->requestProtocol, $httpResponse->code);
		$httpResponse->headers->send();
		print $httpResponse->getResponseBody();
	}

	/**
	 * Get the signature response for the base URI endpoint
	 *
	 * @return object JsonResponse populated with API signature/version
	 */
	protected function signatureResponse() {
		$jsonResponse = PHPGoodies::instantiate('Lib.Net.Http.Rest.JsonResponse');
		$jsonResponse->code = HttpResponse::HTTP_OK;
		$jsonResponse->dto->setProperties(Array('signature', 'version'));
		$jsonResponse->dto->set('signature', $this->signature);
		$jsonResponse->dto->set('version', $this->version);
		return $jsonResponse;
	}

	/**
	 * Get a typical error response document back
	 *
	 * @param string $message The readable plain text error message
	 * @param integer $code A numeric code that correlates to the error messages (1:1)
	 *
	 * @return object JsonResponse populated with error message/code
	 */
	protected function errorResponse($message, $code) {
		$jsonResponse = PHPGoodies::instantiate('Lib.Net.Http.Rest.JsonResponse');
		$jsonResponse->code = $code;
		$jsonResponse->dto->setProperties(Array(
			'message' => $message,
			'code' => $code
		));
		return $jsonResponse;
	}
}

