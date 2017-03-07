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
 * @uses Lib_Net_Http_Request
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
PHPGoodies::import('Lib.Net.Http.Request');
PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.Service.Exception');
PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.Service.Exception.NoAuthentication');
PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.Service.Exception.NoAuthorization');

/**
 * JSON:API Endpoint Controller
 */
abstract class Lib_Net_Api_Rest_JsonApi_Server_Controller {

	/**
	 * The URI_Pattern which attaches us
	 */
	protected $uriPattern;


	/**
	 * The service implementation which does the real work
	 */
	protected $service;

	/**
	 * Default constructor
	 *
	 * @param object $uriPattern Uri_Pattern class instance which attaches us
	 * @param object $service Service implementation which we can count on
	 */
	public function __construct($uriPattern, $service) {
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
	 * Translate an HTTP request into an appropriate service call
	 *
	 * @param object $httpRequest instance of Http.Request
	 *
	 * @return object HTTPResponse instance
	 */
	public function getResponseForRequest($httpRequest) {
		Oop_Type::requireType($httpRequest, 'class:Lib_Net_Http_Request');

		// Prepare to make a call to the service layer depending on which request method...
		switch ($httpRequest->getMethod()) {
			case Lib_Net_Http_Request::HTTP_POST: $serviceMethod = 'create'; break;
			case Lib_Net_Http_Request::HTTP_GET: $serviceMethod = 'retrieve'; break; 
			case Lib_Net_Http_Request::HTTP_PATCH: $serviceMethod = 'update'; break; 
			case Lib_Net_Http_Request::HTTP_DELETE: $serviceMethod = 'delete'; break;
			case Lib_Net_Http_Request::HTTP_PUT: $serviceMethod = 'replace'; break;
			case Lib_Net_Http_Request::HTTP_HEAD: $serviceMethod = 'retrieve'; break;
			case Lib_Net_Http_Request::HTTP_OPTIONS: $serviceMethod ='getMetaData'; break;
			case Lib_Net_Http_Request::HTTP_TRACE: 
				$e = PHPGoodies::instantiate('Lib.Net.Http.Response.MappedException.MethodNodAllowed');
				throw $e;

			default:
				$e = PHPGoodies::instantiate('Lib.Net.Http.Response.MappedException.BadRequest');
				throw $e;
		}

		$httpResponse = $this->serviceCall($serviceMethod, $httpRequest);

		// Strip the response body for HEAD requests
		if ($httpRequest->getMethod() === Lib_Net_Http_Request::HTTP_HEAD) {
			$httpResponse->setResponseBody(null);
		}

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
			// Since the service layer caters to the needs of this specific endpoint,
			// the only variability, then, comes from URI variables. (todo: also add
			// support for passing query string values as arguments, duh!)
			$vars = $this->uriPattern->getUriVariables($uri);
			if (is_null($vars)) {
				$e = PHPGoodies::instantiate('Lib.Net.Http.Response.MappedException.BadRequest');
				throw $e;
			}

			$result = $this->service->{$methodName}($vars);

			// todo: convert result data into a JSON:API HttpResponse structure...
			$response->setBody($result);

			return $response;
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

