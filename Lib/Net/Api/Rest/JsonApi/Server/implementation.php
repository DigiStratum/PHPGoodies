<?php
/**
  * PHPGoodies:Lib_Api_Rest_JsonApi_Server - Provides a JSON:API compliant HTTP REST Server
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Data.String');
PHPGoodies::import('Lib.Net.Http.Request');

/**
 * JSON:API Server
 */
class Lib_Net_Api_Rest_JsonApi_Server {

	/**
	 * Cached copy of the resource map which is dependency-injected
	 */
	protected $resourceMap;

	/**
	 * Constructor
	 *
	 * @param $JsonApiResourceMap Hash map object instance mapping endpoint URI's to
	 * Resource implementations
	 */
	public function __construct($resourceMap) {

		// Check our parameters
		if (is_array($resourceMap) || (count($resourceMap) === 0)) {
			throw new \Exception('Bad Constructor Argument(s)');
		}

		// Check the Resource Map
		foreach ($resourceMap as $pattern => $resourceClassName) {
			if (
				(! PHPGoodies::classDefined($resourceClassName)) ||
				(! in_array('Lib_Net_Api_Rest_Api_JsonApi_Server_Resource', PHPGoodies::classImplements($resourceClassName)))
			) {
				if (is_array($resourceMap) || (count($resourceMap) === 0)) {
					throw new \Exception("Constructor Resource Map contains bad resource for pattern '{$pattern}'");
				}
			}
		}


		$this->resourceMap = $resourceMap;
	}

	/**
	 * HTTP Request Processor
	 *
	 * @param $httpRequest HttpRequest object instance reference to request to be processed
	 *
	 * @return HttpResponse object instance with the result of the processed request
	 */
	public function processRequest(&$httpRequest) {

		// Check our parameters
		if (! $httpRequest instanceof Lib_Net_Http_Request) {
			return $this->responseError(
				Lib_Net_Http_Response::HTTP_INTERNAL_SERVER_ERROR,
				'Invalid Arguments to Process Request'
			);
		}

		try {
			$requestInfo = $httpRequest->getInfo();
			$resource = $this->getResourceForURI($requestInfo->uri);
			if ((null === $resource) || (! $resource instanceof Lib_Net_Api_Rest_JsonApi_Server_Resource)) {
				return $this->responseError(
					Lib_Net_Http_Response::HTTP_BAD_REQUEST,
					'No matching mapped resource for request'
				);
			}

			// Translate from HTTP request method to Resource operation
			switch ($requestInfo->method) {
				case Lib_Net_Http_Request::HTTP_GET: return $this->processRequestRetrieve($requestInfo, $resource);
			}

			// TODO: Execute the appropriate handler method for the given request method against the resource that we received
			// How shall we go about this?
			//  * Switch on request method and call an abstract resource method?
			//  * Call a resource method named after the request method (no switch case) ?
			//  * Use some sort of decorator pattern solution to get a variant of the resource class with just a call method linked to the correct operations based on the request method?
			//  * Call some resource call() method, handing it the request method?
			//  * Call some resource process() method, handing it the entire httpRequest?
		}
		catch (\Exception $e) {
			return $this->responseError(
				Lib_Net_Http_Response::HTTP_INTERNAL_SERVER_ERROR,
				'Unexpected internal error: ' . $e->getMessage()
			);
		}
	}

	/**
	 * Process the request as a resource retrieval
	 *
	 * @param $requestInfo Object with properties describing the request being made
	 * @param $resource Object class instance implementing Resource interface
	 */
	private function processRequestRetrieve($requestInfo, $resource) {
		try {
			// Form a successful response
			$resource->retrieve();
			return $this->createHttpResponse(
				Lib_Net_Http_Response::HTTP_OK,
				$resource->toJson()
			);
		}
		catch (\Exception $e) {
			// TODO: catch different exceptions depending on what went wrong!
			return $this->responseError(
				Lib_Net_Http_Response::HTTP_BAD_REQUEST,
				'Failed retrieval: ' . $e->getMessage()
			);
		}
	}

	/**
	 * Get the matching resource from the resource map for the given URI
	 *
	 * @param $uri string URI for the request being processed
	 */
	private function getResourceForUri($uri) {
		// TODO: Find and return an instance of the first resource that matches this uri in the resource map (they probably all need to be regular expressions...)
	}

	/**
	 * Creates an HttpResponse
	 */
	private function createHttpResponse($code, $body) {
		// Form a full-blown HttpResponse
		$httpResponse = PHPGoodies::instantiate('Lib.Net.Http.Response');
		$httpResponse->headers->set('Content-type', 'application/vnd.api+json');
		$httpResponse->setCode($code);
		$httpResponse->setBody(json_encode($body));

		return $httpResponse;
	}

	/**
	 * Produce an error response
	 *
	 * @param $code Integer HTTP status code
	 * @param $message String readable message text explaining the error
	 */
	private function responseError($code, $message) {

		// Form a simple JSON:API Response Document
		$body = new \StdClass();

		// Form a simple JSON:API ErrorObject
		$errorObject = new \StdClass();
		$errorObject->detail = $message;
		$body->errors = array($message);

		return $this->createHttpResponse($code, $body);
	}
}

