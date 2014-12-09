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

		// Take a uri like '/this/{value}/that/{also}' and turn it into a regex pattern
		$pattern = $uri;
		$map = array();
		if (preg_match_all('|{(.*?)}|', $uri, $matches)) {
			foreach ($matches[0] as $index => $match) {
				//print "Match [{$match}] -> [{$matches[1][$index]}]\n";
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

		// Get some details about this request
		$httpRequest = PHPGoodies::instantiate('Lib.Net.Http.HttpRequest');
		$request = $httpRequest->getInfo();
		$this->requestProtocol = $request->protocol;

		$pattern = $this->getEndpointForUri($request->uri);

		// Expect either baseUri or another validly defined endpoint URI
		if ($request->uri == $this->baseUri) {
			return $this->signatureResponse();
		}
		//else if (! isset($this->endpoints[$request->uri])) {
		else if (! isset($this->endpoints[$pattern])) {
			return $this->errorResponse('Not Found', HttpResponse::HTTP_NOT_FOUND);
		}

		// Verify this RestEndpoint supports the request method
		//$restEndpoint =& $this->endpoints[$request->uri]->endpoint;
		$restEndpoint =& $this->endpoints[$pattern]->endpoint;
		$restMethod = strtolower($request->method);
		if (! $restEndpoint->isImplemented($restMethod)) {
			return $this->errorResponse('Method Not Allowed', HttpResponse::HTTP_METHOD_NOT_ALLOWED);
		}

		// Get the natural response from the RestEndpoint
		return $restEndpoint->$restMethod(
			$httpRequest,
			$this->getEndpointParams($request->uri, $pattern)
		);
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
		$jsonResponse->dto->setProperties(Array(
			'message' => $message,
			'code' => $code
		));
		return $jsonResponse;
	}
}

