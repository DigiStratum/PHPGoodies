<?php
/**
 * PHPGoodies:RestApi - RESTful API shell
 *
 * @uses RestEndpoint
 * @uses RequestInfo
 * @uses HttpResponse
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
	 * The set of RestEndpoints that we are hosting
	 */
	protected $endpoints = array();

	/**
	 * The base URI for this API all others are relative to
	 */
	protected $baseUri;

	/**
	 * Constructor
	 *
	 * @param string $baseUri The base URI for this API all others are relative to
	 * @param string $signature API signature string which will be in the default response
	 */
	public function __construct($baseUri, $signature = 'REST API'() {
		$this->baseUri = $baseUri;
		$this->signature = $signature;
	}

	/**
	 * Add an API endpoint
	 *
	 * @param string $uri The URI that will invoke this RestEndpoint's handlers
	 * @param object RestEndpoint handler for this URI
	 */
	public function addEndpoint($uri, &$restEndpiont) {
		if (! $restEndpoint instanceof RestEndpoint) {
			throw new exception('Something other than a RestEndpoint was supplied');
		}
		$this->endpoints[$uri] =& $restEndpoint;
	}

	/**
	 * Get the response that the API RestEndpoint would be to the current request
	 *
	 * @return object An instance of HttpResponse (or a subclass) with all the details inside
	 */
	public function getResponse() {
		$requestInfo = PHPGoodies::instantiate('Lib.Net.Http.RequestInfo');
		$request = $requestInfo->getInfo();

		if ($request['uri'] == $this->baseUri) {
			// TODO - default response (signature DTO)
			// $httpResponse = ...
		}
		else if (! isset($this->endpoints[$request['uri']])) {
			// TODO - 404 response
			// $httpResponse = ...
		}
		else {
			$restMethod = $request['method'];
			$restEndpoint =& $this->endpoints[$request['uri']];
			$httpResponse = $restEndpoint->$restMethod($requestInfo);
		}
		return $httpResponse;
	}

	/**
	 * Actually send the response out to the client, headers, code, body, and all
	 */
	public function respond($httpResponse) {
		if (! $httpResponse instanceof HttpResponse) {
			throw new exception('Something other than an HttpResponse was supplied');
		}
	}
}

