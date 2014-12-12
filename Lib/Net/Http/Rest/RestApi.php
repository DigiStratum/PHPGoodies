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
	 * The current REST request
	 */
	protected $restRequest;

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

		// Take a uri like '/this/{value}/that/{also}' and turn it into a regex pattern
		$pattern = $uri;
		$map = array();
		if (preg_match_all('|{(.*?)}|', $uri, $matches)) {
			foreach ($matches[0] as $index => $match) {
				$map[$index] = $matches[1][$index];
				$pattern = str_replace($match, '(.*?)', $pattern);
			}
		}

		$this->endpoints[$pattern] = new \StdClass();
		$this->endpoints[$pattern]->endpoint =& $restEndpoint;
		$this->endpoints[$pattern]->map = $map;

		return $this;
	}

	/**
	 * Get the response that the API RestEndpoint would be to the current request
	 *
	 * @return object An instance of HttpResponse (or a subclass) with all the details inside
	 */
	public function getResponse() {

		// Capture some details about this request
		$this->restRequest = PHPGoodies::instantiate('Lib.Net.Http.Rest.RestRequest');
		$request = $this->restRequest->getInfo();
		$pattern = $this->getEndpointForUri($request->uri);
		$this->restRequest->setPattern($pattern);
		$this->restRequest->setParams($this->getEndpointParams($request->uri, $pattern));

		// Handle requests for the baseUri
		if ($request->uri == $this->baseUri) {
			return $this->signatureResponse();
		}

		// Handle requests for undefined endpoints
		$restEndpoint =& $this->getEndpointForPattern($pattern);
		if (null == $restEndpoint) {
			return $this->errorResponse('Not Found!', HttpResponse::HTTP_NOT_FOUND);
		}

		// Verify this RestEndpoint supports the request method
		$restMethod = strtolower($request->method);
		if (! $restEndpoint->isImplemented($restMethod)) {
			return $this->errorResponse('Method Not Allowed', HttpResponse::HTTP_METHOD_NOT_ALLOWED);
		}

		// Get the natural response from the RestEndpoint
		return $restEndpoint->$restMethod($this->restRequest);
	}

	/**
	 * Extract data elements from the URI with the pattern and associated map
	 *
	 * @param string $uri a URI as requested
	 * @param string $pattern a previously configured pattern (key of $this->endpoints)
	 *
	 * @return array of name=value pairs from the URI or null if none
	 */
	protected function getEndpointParams($uri, $pattern) {
		if (preg_match("|^{$pattern}$|", $uri, $matches)) {
			$map =& $this->endpoints[$pattern]->map;
			$params = array();

			for ($xx = 1; $xx < count($matches); $xx++) {
				$params[$map[$xx - 1]] = $matches[$xx];
			}
			return $params;
		}
		return null;
	}

	/**
	 * Figure out which endpoint's pattern matches this uri
	 *
	 * @param string $uri a URI as requested
	 *
	 * @return string the pattern key from $this->endpoints which matches
	 */
	protected function getEndpointForUri($uri) {
		foreach (array_keys($this->endpoints) as $pattern) {
			if (preg_match("|^{$pattern}$|", $uri)) {
				return $pattern;
			}
		}
		return null;
	}

	/**
	 * Get the endpoint with the specified URI pattern
	 *
	 * @param string $pattern A regex URI pattern that we want to check for
	 *
	 * @return object Reference to RestEndpoint that matches the pattern or null if no match
	 */
	protected function &getEndpointForPattern($pattern) {
		if (! $this->hasEndpointForPattern($pattern)) {
			$null = null;
			return $null;
		}
		return $this->endpoints[$pattern]->endpoint;
	}

	/**
	 * Check whether we have an endpoint for the specified URI patternn
	 *
	 * @param string $pattern A regex URI pattern that we want to check for
	 *
	 */
	protected function hasEndpointForPattern($pattern) {
		return isset($this->endpoints[$pattern]);
	}

	/**
	 * Actually send the response out to the client, headers, code, body, and all
	 */
	public function respond($httpResponse) {
		if (! $httpResponse instanceof HttpResponse) {
			throw new \Exception('Something other than an HttpResponse was supplied');
		}
		// Add a header for the HTTP/S response
		$requestProtocol = $this->restRequest->getInfo()->protocol;
		$httpResponse->headers->set($requestProtocol, $httpResponse->code);
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
		$jsonResponse->dto->setProperties(
			Array(
				'signature' => $this->signature,
				'version' => $this->version
			)
		);
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
		$jsonResponse->dto->setProperties(
			Array(
				'message' => $message,
				'code' => $code
			)
		);
		return $jsonResponse;
	}
}

