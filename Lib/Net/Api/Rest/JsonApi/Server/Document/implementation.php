<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Server_Document - JSON:API Document class
 *
 * @uses Lib_Net_Api_Rest_JsonApi_Server_JsonApi
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.Errors');
PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.Links');
PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.Meta');

/**
 * JSON:API Document class
 */
class Lib_Net_Api_Rest_JsonApi_Server_Document implements \JsonSerializable {

	/**
	 * Primary data for this resource endpoint; Must NOT have this if we have errors
	 */
	protected $data;

	/**
	 * Error(s) for this particular request; Must NOT have this if we have data
	 */
	protected $errors;

	/**
	 * Non-standard meta information for this endpoint/request; Must have this if neither data nor errors
	 */
	protected $meta;

	/**
	 * Details about our JSON:API implementation; May have this
	 */
	protected $jsonapi;

	/**
	 * Links related to the primary data; May have this
	 */
	protected $links;
	
	/**
	 * Collection of resource objects related to the primary data
	 */
	protected $included;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->data = null;
		$this->errors = null;
		$this->meta = null;
		$this->links = null;
		$this->included = null;
		$this->jsonapi = PHPGoodies::instantiate('Lib.Net.Api.Rest.JsonApi.Server.JsonApi');
	}

	/**
	 * Sets the data property of the response document
	 *
	 * @fixme Rework the resource/data classes to structure this input...
	 *
	 * @param object $data ResourceData class instance
	 *
	 * @return object $this for chaining...
	 */
	public function setData($data) {
		if ((! is_null($errors)) && (! is_null($data))) {
			throw new \Exception('Cannot have data if errors are set!');
		}
		$this->data = $data;
		return $this;
	}

	/**
	 * Sets the errors property of the response document
	 *
	 * @param object $errors Errors collection instance of Error class instance(s)
	 *
	 * @return object $this for chaining...
	 */
	public function setErrors(Lib_Net_Api_Rest_JsonApi_Server_Errors $errors) {
		if ((! is_null($data)) && (! is_null($errors))) {
			throw new \Exception('Cannot have errors if data is set!');
		}
		$this->errors = $errors;
		return $this;
	}


	/**
	 * Sets the non-standard meta information of the response document
	 *
	 * @param object $meta Meta class instance; Non-standard metadata for the response document
	 *
	 * @return object $this for chaining...
	 */
	public function setMeta(Lib_Net_Api_Rest_JsonApi_Server_Meta $meta) {
		$this->meta = $meta;
		return $this;
	}

	/**
	 * Sets the collection of links for the response document
	 *
	 * @param object $links Links class instance
	 *
	 * @return object $this for chaining...
	 */
	public function setLinks(Lib_Net_Api_Rest_JsonApi_Server_Links $links) {
		$this->links = $links;
		return $this;
	}

	/**
	 * Sets the collection of resource objects related to the primary data
	 *
	 * @param object $included Resources Collection of Resource class instances
	 *
	 * @return object $this for chaining...
	 */
	public function setIncluded($included) {
		if (is_null($data)) {
			throw new \Exception('Cannot include resources if no primary data is set!');
		}
		$this->included = $included;
		return $this;
	}

	/**
         * JsonSerializable Json Serializer
	 *
	 * @return Associative array of properties which will be encoded as the JSON representation
	 * of object instances of this class
	 */
	public function jsonSerialize() {
		return [
			'data' => $this->data,
			'errors' => $this->errors,
			'meta' => $this->meta,
			'jsonapi' => $this->jsonapi,
			'links' => $this->links,
			'included' => $this->included
		];
	}
}

