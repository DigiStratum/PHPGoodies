<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Server_ResourceIdentifier - Resource Identifier Class
 *
 * @uses Lib_Net_Api_Rest_JsonApi_Server_PrimaryData
 * @uses Lib_Net_Api_Rest_JsonApi_Meta
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.PrimaryData');
PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Meta');

/**
 * JSON:API Resource Identifier class
 */
class Lib_Net_Api_Rest_JsonApi_Server_ResourceIdentifier implements \JsonSerializable, Lib_Net_Api_Rest_JsonApi_Server_PrimaryData {

	/**
	 * unique identifier for this resource (within the type)
	 */
	protected $id;

	/**
	 * type of resource
	 */
	protected $type;

	/**
	 * non-standard metadata for this resource; optional, may be null
	 */
	protected $meta;

	/**
	 * Constructor
	 *
	 * @param string $id unique identifier for this resource (within the type)
	 * @param string $type type of resource
	 * @param object $meta Meta class instance; optional, default is null
	 */
	public function __construct(string $id, string $type, Lib_Net_Api_Rest_JsonApi_Meta $meta = null) {
		$this->id = $id;
		$this->type = $type;
		$this->meta = $meta;
	}

	/**
	 * JsonSerializable Json Serializer
	 *
	 * @return Associative array of properties which will be encoded as the JSON representation
	 * of object instances of this class
	 */
	public function jsonSerialize() {
		return [
			'id' => $this->id,
			'type' => $this->type,
			'meta' => $this->meta
		];
	}
}
