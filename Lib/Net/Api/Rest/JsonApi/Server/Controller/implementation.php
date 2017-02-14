<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Controller - JSON:API Endpoint Controller
 *
 * @uses Oop_Type
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
		$this->uriPattern = Oop_Type::requireType($uriPattern, 'class:Lib_Net_Api_Rest_JsonApi_Server_Uri_Pattern');
		$this->service = Oop_Type::requireType($service, 'class:Lib_Net_Api_Rest_JsonApi_Server_Service');
	}

	/**
	 * Return the UriPattern which attaches us
	 *
	 * @return object Uri_Pattern class instance
	 */
	abstract static public function getUriPattern();

	/**
	 * Handle an HTTP GET request
	 */
	public function doGet() {
		$this->service->retrieve();
	}

	/**
	 * Handle an HTTP POST request
	 */
	public function doPost() {
		$this->service->create();
	}

	/**
	 * Handle an HTTP PUT request
	 */
	public function doPut() {
		$this->service->replace();
	}

	/**
	 * Handle an HTTP PATCH request
	 */
	public function doPatch() {
		$this->service->modify();
	}

	/**
	 * Handle an HTTP HEAD request
	 */
	public function doHead() {
		$this->service->peek();
	}

	/**
	 * Handle an HTTP OPTIONS request
	 */
	public function doOptions() {
		$this->service->check();
	}
}

