<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Endpoint - Abstract class for a single endpoint
 *
 * @uses Lib_Net_Api_Rest_JsonApi_Server_Uri_Pattern
 * @uses Lib_Net_Api_Rest_JsonApi_Server_Document
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
	 * Constructor
	 */
	public function __construct($uriPattern, $supportedVerbs) {
		$this->uriPattern = Oop_Type::requireType($uriPattern, 'class:Lib_Net_Api_Rest_JsonApi_Server_Uri_Pattern');

		// Supported verbs is so that we can respond to OPTIONS requests as well as reject any unsupported verbs without thinking too hard.
		$this->supportedVerbs = Oop_Type::requireType($supportedVerbs, 'array');
	}

	/**
	 * Get the URI Pattern for this endpoint
	 *
	 * This is useful so that we can have a collection of Endpoints which we can iterate over in
	 * the server and check the pattern for each for a given httpRequest and then know which
	 * endpoint is the appropriate one to launch.
	 *
	 * @todo :resolve how this helps us if we want to just have an array of patterns-to-classnames
	 * without instantiating the relevant endpoint classname until we know it is needed to service
	 * the request? Can we make it static so that anyone can check that out of the endpoint without
	 * having an instance yet?
	 */
	public function getUriPattern() {
		return $this->uriPattern;
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
		Oop.Type::requireType($request, 'class:Lib_Net_Http_Request');
		$document = PHPGoodies::instantiate('Lib.Net.Api.Rest.JsonApi.Server.Document');
		return $document;
	}
}

