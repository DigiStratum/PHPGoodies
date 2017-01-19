<?php
/**
  * PHPGoodies:Lib_Api_Rest_JsonApi_Server - Provides a JSON:API compliant HTTP REST Server
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

PHPGoodies::import('Lib.Data.String');

/**
 * JSON:API Server
 */
class Lib_Net_Api_Rest_JsonApi_Server {

	/**
	 * Cached copy of the resource factory map which is dependency-injected
	 */
	protected $jsonApiResourceFactoryMap;

	/**
	 * Constructor
	 *
	 * @param $JsonApiResourceFactoryMap Hash map object instance mapping endpoint URI's to
	 * JsonApiResource implementations
	 */
	public function __construct($jsonApiResourceFactoryMap) {
		$this->jsonApiResourceFactoryMap = $jsonApiResourceFactoryMap;
	}

	/**
	 * HTTP Request Processor
	 *
	 * @param $httpRequest HttpRequest object instance holding the request to be processed
	 *
	 * @return HttpResponse object instance with the result of the processed request
	 */
	public function processRequest($httpRequest) {
		try {
			$requestInfo = $httpRequest->getInfo();
			$resource = $this->getResourceForURI($requestInfo->uri);
			if (null === $resource) {
				return $this->responseError(Lib_Net_Http_Response::HTTP_BAD_REQUEST, 'This request did not match anything in our resource map');
			}

			// TODO: Execute the appropriate handler method for the given request method against the resource that we received
		}
		catch (\Exception $e) {
			return $this->responseError(Lib_Net_Http_Response::HTTP_INTERNAL_SERVER_ERROR, 'An unexpected, internal error occurred: ' . $e->getMessage());
		}
	}

	/**
	 * Get the matching resource from the factory map for the given URI
	 *
	 * @param $uri string URI for the request being processed
	 */
	private function getResourceForUri($uri) {
		// TODO: Find and return an instance of the first resource that matches this uri in the resource map (they probably all need to be regular expressions...)
	}

	/**
	 * Factory method to produce error responses
	 *
	 * @param $code Integer HTTP status code
	 * @param $message String readable message text explaining the error
	 */
	private function responseError($code, $message) {

		// Form a simple JSON:API ErrorObject
		$errorObject = new \StdClass();
		$errorObject->detail = $message;

		// Form a simple JSON:API Response Document
		$body = new \StdClass();
		$body->errors = array($message);

		// Form a full-blown HttpResponse
		$httpResponse = PHPGoodies::instantiate('Lib.Net.Http.Response');
		$httpResponse->headers->set('Content-type', 'application/vnd.api+json');
		$httpResponse->setCode($code);
		$httpResponse->setBody(json_encode($body));

		return $httpResponse;
	}
}

