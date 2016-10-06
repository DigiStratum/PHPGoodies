<?php
/**
 * PHPGoodies:JsonResponse - RESTful API JSON response container
 *
 * Extends the basic HTTP Response with a JSON structure for your typical formatted response from
 * a RESTful endpoint. This is not the default for RestResponse because REST can return any type of
 * response, not just JSON, so we want to enable our API's to do that generally, but also make it
 * easy to return typical JSON structures as an extension of that.
 *
 * @uses Lib_Net_Http_Response
 * @uses Oop_Dto_Dtos_Generic
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Net.Http.Response');

/**
 * RESTful API JSON response container
 */
class Lib_Net_Http_Rest_Response_Json extends Lib_Net_Http_Response {

	/**
	 * The DTO that we will carry along to collect data and format JSON output
	 */
	public $dto;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();

		// Initially the DTO will be generic so it's usable but caller can over-write
		$this->dto = PHPGoodies::instantiate('Oop.Dto.Dtos.Generic');
		$this->mimetype = 'application/json';
	}

	/**
	 * Override the response body by forcing it to be the JSON output of the DTO
	 *
	 * @return string JSON formatted text of the body
	 */
	public function getResponseBody() {
		$this->body = $this->dto->toJson();
		return parent::getResponseBody();
	}
}

