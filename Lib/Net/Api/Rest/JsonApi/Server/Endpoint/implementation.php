<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Endpoint - Abstract class for a single endpoint
 *
 * There are two modes of use: static and instantiated; the static class has a method to return the
 * UriPattern, and the instantiated one leverages this static method as well as provides instance
 * methods for handling requests.
 *
 * @uses Oop_Type
 * @uses Lib_Net_Api_Rest_JsonApi_Server_Uri_Pattern
 * @uses Lib_Net_Api_Rest_JsonApi_Server_Document
 * @uses Lib_Net_Api_Rest_JsonApi_Server_Controller
 * @uses Lib_Net_Http_Request
 * @uses Lib_Net_Http_Response
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Oop.Type');
PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.Uri.Pattern');
PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.Document');

/**
 * JSON:API Single endpoint base class
 *
 * Each of the abstract methods is documented with certain expectations of the subclass behavior.
 */
abstract class Lib_Net_Api_Rest_JsonApi_Server_Endpoint {

	/**
	 * URI Pattern which we will use to decode request URIs which we are expected to handle
	 */
	protected $uriPattern;

	/**
	 * The JSON:API controller which will handle requests for this endpoint
	 */
	protected $controller;

	/**
	 * Constructor
	 *
	 * @param object $uriPattern JSON:API UriPattern for this API endpoint
	 * @param object $controller JSON:API Controller for this API endpoint
	 */
	public function __construct($uriPattern, $controller) {
		$this->uriPattern = Oop_Type::requireType($uriPattern, 'class:Lib_Net_Api_Rest_JsonApi_Server_Uri_Pattern');

		// The dependency-injected JSON:API controller which will handle requests for this endpoint
		$this->controller = Oop_Type::requireType($controller, 'class:Lib_Net_Api_Rest_JsonApi_Server_Controller');
	}

	/**
	 * Get the URI Pattern for this endpoint
	 *
	 * This is useful so that we can have a collection of Endpoints which we can iterate over in
	 * the server and check the pattern for each for a given httpRequest and then know which
	 * endpoint is the appropriate one to launch.
	 *
	 * @return object JSON:API UriPattern which will match requests for this endpoint
	 */
	static abstract public function getUriPattern();

	/**
	 * Handle the supplied HTTP Request
	 */
	public function handleRequest($httpRequest) {
		Oop.Type::requireType($httpRequest, 'class:Lib_Net_Http_Request');
		$response = $this->getResponse($httpRequest);
		$response->headers->send();
	}

	protected function getResponse($httpRequest) {
		$response = PHPGoodies::instantiate('Lib.Net.Http.Response');
		return $response;
	}

	/**
	 * Get the JSON:API expected response document for this endpoint based on the request
	 *
	 * For a given implementation, if you want this endpoint to return anything other than an
	 * empty document, then you must override this endpoint. The subclass can call this parent
	 * method to get the bare document to begin filling in depending on the results of the
	 * request.
	 *
	 * @param Lib_Net_Http_Request $request Request object that we are responding to
	 *
	 * @return Lib_Net_Api_Rest_JsonApi_Server_Document response document
	 */
	protected function getResponseDocument($request) {
		$document = PHPGoodies::instantiate('Lib.Net.Api.Rest.JsonApi.Server.Document');
		return $document;
	}
}

