<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Endpoint - Abstract class for a single endpoint
 *
 * @uses Lib_Net_Api_Rest_JsonApi_Server_Uri_Pattern
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.Uri.Pattern');

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
	public function __construct(Lib_Net_Api_Rest_JsonApi_Server_Uri_Pattern $uriPattern, array $supportedVerbs) {
		$this->uriPattern = $uriPattern;
		// Supported verbs is so that we can respond to OPTIONS requests as well as reject any unsupported verbs without thinking too hard.
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
	 * GET the resource for this endpoint
	 */
	public function httpGetHandler(Lib_Net_Http_Request $request) {

		$info = $request->getInfo();

		$document  = PHPGoodies::instantiate('Lib.Net.Api.Rest.JsonApi.Server.Document');
		// TODO: do something here like call an abstract method which the subclass must provide to fill in the document on GET...
		return $document;
	}



}

