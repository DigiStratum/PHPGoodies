<?php
/**
 * PHPGoodies:Lib_Net_Http_Rest_Api - RESTful API shell
 *
 * @todo Abstract Oauth2AuthServer as some sort of generic AuthServer or "request filter" that will
 * allow the calling code to supply anything within a range of classes derived from a common
 * interface so that not just Oauth2 may be used. Unclear how important this is as Oauth2 may be
 * both sufficient and desired for everything moving forward... but to make the change sooner than
 * not would improve futureproofing...
 *
 * @uses Lib_Net_Http_Response
 * @uses Lib_Net_Http_Rest_Request
 * @uses Lib_Net_Rest_Endpoint
 * @uses Lib_Net_Rest_Response_Json
 * @uses Lib_Net_Http_Oauth2_Auth_Server
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Net.Http.Rest.Endpoint');
PHPGoodies::import('Lib.Net.Http.Response');
PHPGoodies::import('Lib.Net.Http.Oauth2.Auth.Server');

/**
 * RESTful API shell
 */
class Lib_Net_Http_Rest_Api {

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
	 * The Auth Server that we will be using
	 */
	protected $authServer = null;

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
	 * Sets the custom Auth Server that we will be using
	 *
	 * @param object $authServer an instance of Oauth2AuthServer
	 *
	 * @return object $this for chaining support
	 */
	public function setAuthServer($authServer) {
		if (! $authServer instanceof Lib_Net_Http_Oauth2_Auth_Server) {
			throw new \Exception('Something other than an Oauth2AuthServer was supplied');
		}
		$this->authServer = $authServer;
		return $this;
	}

	/**
	 * Add an API endpoint
	 *
	 * @param string $uri The URI that will invoke this RestEndpoint's handlers
	 * @param object $RestEndpoint handler for this URI
	 * @param string $authScope The authorization scope required to access this endpoint
	 *
	 * @return object $this for chaining support...
	 */
	public function addEndpoint($uri, &$restEndpoint, $authScope = '') {
		if (! $restEndpoint instanceof Lib_Net_Http_Rest_Endpoint) {
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
		$this->endpoints[$pattern]->authScope = is_string($authScope) ? $authScope : '';

		return $this;
	}

	/**
	 * Get the response that the API RestEndpoint would be to the current request
	 *
	 * @return object An instance of HttpResponse (or a subclass) with all the details inside
	 */
	public function getResponse() {

		// Capture some details about this request
		$this->restRequest = PHPGoodies::instantiate('Lib.Net.Http.Rest.Request');
		$request = $this->restRequest->getInfo();

		// Handle requests for the baseUri
		if ($request->uri == $this->baseUri) {
			return $this->signatureResponse();
		}

		// Handle requests for undefined endpoints
		$pattern = $this->getEndpointForUri($request->uri);
		$restEndpoint =& $this->getEndpointForPattern($pattern);
		if (null == $restEndpoint) {
			return $this->errorResponse('Not Found!', Lib_Net_Http_Response::HTTP_NOT_FOUND);
		}

		// Verify this RestEndpoint supports the request method
		$restMethod = strtolower($request->method);
		if (! $restEndpoint->isImplemented($restMethod)) {
			return $this->errorResponse('Method Not Allowed', Lib_Net_Http_Response::HTTP_METHOD_NOT_ALLOWED);
		}

		// Check authentication/authorization
		if (strlen($this->endpoints[$pattern]->authScope) && ($this->authServer instanceof Lib_Net_Http_Oauth2_Auth_Server)) {
			if (! $this->authServer->hasScopeAuthorization($this->restRequest, $this->endpoints[$pattern]->authScope)) {
				return $this->errorResponse('Unauthorized', Lib_Net_Http_Response::HTTP_UNAUTHORIZED);
			}
		}

		// Get the natural response from the RestEndpoint
		$this->restRequest->setPattern($pattern);
		$this->restRequest->setParams($this->getEndpointParams($request->uri, $pattern));
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
		if (! $httpResponse instanceof Lib_Net_Http_Response) {
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
		$jsonResponse = PHPGoodies::instantiate('Lib.Net.Http.Rest.Response.Json');
		$jsonResponse->code = Lib_Net_Http_Response::HTTP_OK;
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
		$jsonResponse = PHPGoodies::instantiate('Lib.Net.Http.Rest.Response.Json');
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

