<?php
/**
 * PHPGoodies:RestApi - RESTful API shell
 *
 * @uses HttpResponse
 * @uses HttpRequest
 * @uses RestEndpoint
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

		// Get some details about this request
		$httpRequest = PHPGoodies::instantiate('Lib.Net.Http.HttpRequest');
		$request = $httpRequest->getInfo();
		$this->requestProtocol = $request->protocol;

		// Expect either baseUri or another validly defined endpoint URI
		if ($request->uri == $this->baseUri) {
			return $this->signatureResponse();
		}
		else if (! isset($this->endpoints[$request->uri])) {
			return $this->errorResponse('Not Found', HttpResponse::HTTP_NOT_FOUND);
		}

		// Verify this RestEndpoint supports the request method
		$restEndpoint =& $this->endpoints[$request->uri];
		$restMethod = strtolower($request->method);
		if (! $restEndpoint->isImplemented($restMethod)) {
			return $this->errorResponse('Method Not Allowed', HttpResponse::HTTP_METHOD_NOT_ALLOWED);
		}

		// Get the natural response from the RestEndpoint
		$response = $restEndpoint->$restMethod($httpRequest);

		// Add CORS headers if necessary
		if ($restEndpoint->hasCorsPolicy()) {

			// CORS headers may only be matched to requests that supply an origin
			if ($request->headers->has('Origin')) {

				// Got a match for origin in the CorsPolicy for this request method?
				$origin = $request->headers->get('Origin');
				$method = $request->method;
				$corsPolicy =& $restEndpoint->getCorsPolicy();
				$match = $corsPolicy->getMatchingMethodOrigin($method, $origin);
				if (! is_null($match)) {

					// Add a CORS header to the response with the policy that matched
					$response->headers->set('Access-Control-Allow-Origin', $match);
				}
			}
		}

		return $response;
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

