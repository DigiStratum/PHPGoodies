<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Controller - JSON:API Endpoint Controller
 *
 * @uses Oop_Type
 * @uses Lib_Net_Api_Rest_JsonApi_Server_UriPattern
 * @uses Lib_Net_Api_Rest_JsonApi_Server_Service
 * @uses Lib_Net_Api_Rest_JsonApi_Server_Service_Exception
 * @uses Lib_Net_Api_Rest_JsonApi_Server_Service_Exception_NoAuthentication
 * @uses Lib_Net_Api_Rest_JsonApi_Server_Service_Exception_NoAuthorization
 * @uses Lib_Net_Http_Response
 * @uses Lib_Net_Http_Response_MappedException_BadRequest
 * @uses Lib_Net_Http_Response_MappedException_Unauthorized
 * @uses Lib_Net_Http_Response_MappedException_ServerError
 * @uses Lib_Net_Http_Response_MappedException_Forbidden
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Oop.Type');
PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.Service.Exception');
PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.Service.Exception.NoAuthentication');
PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.Service.Exception.NoAuthorization');

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
	 * Checks whether the UriPattern which attaches us matches the supplied URI
	 *
	 * @param string $uri Portion of a URL that we want to know whether is a match for us
	 *
	 * @return boolean true if the supplied URI matches us, else false
	 */
	abstract static public function matchesUri($uri);

	/**
	 * Translate an HTTP POST request into a service call
	 *
	 * @param object $httpRequest instance of Http.Request
	 *
	 * @return object HTTPResponse instance
	 */
	public function doPost($httpRequest) {
		return $this->serviceCall('create', $httpRequest);
	}

	/**
	 * Translate an HTTP GET request into a service call
	 *
	 * @param object $httpRequest instance of Http.Request
	 *
	 * @return object HTTPResponse instance
	 */
	public function doGet($httpRequest) {
		return $this->serviceCall('retrieve', $httpRequest);
	}

	/**
	 * Translate an HTTP PATCH request into a service call
	 *
	 * @param object $httpRequest instance of Http.Request
	 *
	 * @return object HTTPResponse instance
	 */
	public function doPatch($httpRequest) {
		return $this->serviceCall('update', $httpRequest);
	}

	/**
	 * Translate an HTTP DELETE request into a service call
	 *
	 * @param object $httpRequest instance of Http.Request
	 *
	 * @return object HTTPResponse instance
	 */
	public function doDelete($httpRequest) {
		return $this->serviceCall('delete', $httpRequest);
	}

	/**
	 * Translate an HTTP PUT request into a service call
	 *
	 * @param object $httpRequest instance of Http.Request
	 *
	 * @return object HTTPResponse instance
	 */
	public function doPut($httpRequest) {
		return $this->serviceCall('replace', $httpRequest);
	}

	/**
	 * Translate an HTTP HEAD request into a service call
	 *
	 * @param object $httpRequest instance of Http.Request
	 *
	 * @return object HTTPResponse instance
	 */
	public function doHead($httpRequest) {
		return $this->serviceCall('getMetadata', $httpRequest);
	}

	/**
	 * Translate an HTTP OPTIONS request into a service call
	 *
	 * @param object $httpRequest instance of Http.Request
	 *
	 * @return object HTTPResponse instance
	 */
	public function doOptions($httpRequest) {
		$httpResponse = $this->serviceCall('retrieve', $httpRequest);
		$httpResponse->setResponseBody(null);
		return $httpResponse;
	}

	/**
	 * Dispatch any of the above handlers' service calls
	 *
	 * @param string $methodName Name of the service method we want to invoke
	 *
	 * @return object HTTPResponse instance
	 *
	 * @throws InvalidRequest
	 */
	protected function serviceCall($methodName, $httpRequest) {

		$uri = $httpRequest->getPath();

		// Formulate an HTTP response, for better or worse!
		$response = PHPGoodies::instantiate('Lib.Net.Http.Response');

		try {
			$vars = $this->uriPattern->getUriVariables($uri);
			if (is_null($args)) {
				$e = PHPGoodies::instantiate('Lib.Net.Http.Response.MappedException.BadRequest');
				throw $e;
			}

			return $this->service->{$methodName}($vars);
		}

		// Convert JsonApi.Server.Service.Exception to Http.Response MappedException
		catch (Lib_Net_Api_Rest_JsonApi_Server_Service_Exception_NoAuthentication $e) {
			$e = PHPGoodies::instantiate('Lib.Net.Http.Response.MappedException.Unauthorized');
			throw $e;
		}
		catch (Lib_Net_Api_Rest_JsonApi_Server_Service_Exception_NoAuthorization $e) {
			$e = PHPGoodies::instantiate('Lib.Net.Http.Response.MappedException.Forbidden');
			throw $e;
		}
		catch (\Exception $e) {
			$e = PHPGoodies::instantiate('Lib.Net.Http.Response.MappedException.ServerError');
			throw $e;
		}
	}
}

