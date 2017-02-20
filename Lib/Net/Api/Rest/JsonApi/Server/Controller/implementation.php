<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Controller - JSON:API Endpoint Controller
 *
 * @uses Oop_Type
 * @uses Lib_Net_Api_Rest_JsonApi_Server_UriPattern
 * @uses Lib_Net_Api_Rest_JsonApi_Server_Service
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Oop.Type');

/**
 * JSON:API Endpoint Controller
 */
abstract class Lib_Net_Api_Rest_JsonApi_Controller {

	/**
	 * The URI_Pattern which attaches us
	 */
	protected $uriPattern;


	/**
	 * The service implementation which does the real work
	 */
	protected $service;

	/**
	 * Default controller
	 *
	 * @param object $uriPattern Uri_Pattern class instance which attaches us
	 * @param object $service Service implementation which we can count on
	 */
	public function __controller($uriPattern, $service) {
		$this->uriPattern = Oop_Type::requireType($uriPattern, 'class:Lib_Net_Api_Rest_JsonApi_Server_UriPattern');
		$this->service = Oop_Type::requireType($service, 'class:Lib_Net_Api_Rest_JsonApi_Server_Service');
	}

	/**
	 * Handle an HTTP OPTIONS request
	 *
	 * @param string $uri The URI of the request we want to match against our UriPattern
	 *
	 * @return object HTTPResponse instance
	 */
	public function doOptions($uri) {
	}

	/**
	 * Checks whether the UriPattern which attaches us matches the supplied URI
	 *
	 * @param string $uri Portion of a URL that we want to know whether is a match for us
	 *
	 * @return boolean true if the supplied URI matches us, else false
	 */
	abstract static public function matchesUri($uri);

	/**
	 * Handle an HTTP POST request
	 *
	 * @param string $uri The URI of the request we want to match against our UriPattern
	 *
	 * @return object HTTPResponse instance
	 */
	public function doPost($uri) {
		$this->serviceCall('create', $uri);
	}

	/**
	 * Handle an HTTP GET request
	 *
	 * @param string $uri The URI of the request we want to match against our UriPattern
	 *
	 * @return object HTTPResponse instance
	 */
	public function doGet($uri) {
		$this->serviceCall('retrieve', $uri);
	}

	/**
	 * Handle an HTTP PATCH request
	 *
	 * @param string $uri The URI of the request we want to match against our UriPattern
	 *
	 * @return object HTTPResponse instance
	 */
	public function doPatch($uri) {
		$this->serviceCall('update', $uri);
	}

	/**
	 * Handle an HTTP DELETE request
	 *
	 * @param string $uri The URI of the request we want to match against our UriPattern
	 *
	 * @return object HTTPResponse instance
	 */
	public function doDelete($uri) {
		$this->serviceCall('delete', $uri);
	}

	/**
	 * Handle an HTTP PUT request
	 *
	 * @param string $uri The URI of the request we want to match against our UriPattern
	 *
	 * @return object HTTPResponse instance
	 */
	public function doPut($uri) {
		$this->serviceCall('replace', $uri);
	}

	/**
	 * Handle an HTTP HEAD request
	 *
	 * @param string $uri The URI of the request we want to match against our UriPattern
	 *
	 * @return object HTTPResponse instance
	 */
	public function doHead($uri) {
		$this->serviceCall('getMetadata', $uri);
	}

	/**
	 * Make dispath any of the above handlers' service calls
	 *
	 * @param string $methodName Name of the service method we want to invoke
	 * @param string $uri The URI of the request we want to match against our UriPattern
	 *
	 * @return object HTTPResponse instance
	 *
	 * @throws InvalidRequest
	 */
	protected function serviceCall($methodName, $uri) {

		// Formulate an HTTP response, for better or worse!
		$response = PHPGoodies::instantiate('Lib.Net.Http.Response');

		try {
			$vars = $this->uriPattern->getUriVariables($uri);
			if (is_null($args)) {
				throw new \Exception('400 BAD REQUEST');
			}
		}

		// Map JsonApi.Server.Exceptions to HTTP RESPONSES
		catch (Lib_Net_Api_Rest_JsonApi_Server_Exception_NoAuthentication $e) {
		}
		catch (Lib_Net_Api_Rest_JsonApi_Server_Exception, \Exception $e) {
		}

		return $this->service->{$methodName}($vars);
	}
}

