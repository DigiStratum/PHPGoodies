<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Server_Relationship - Resource Class
 *
 * @uses Lib_Net_Api_Rest_JsonApi_Server_Links
 * @uses Lib_Net_Api_Rest_JsonApi_Server_Meta
 * @uses Lib_Net_Api_Rest_JsonApi_Server_ResourceLinkage
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.Links');
PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.Meta');
PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.ResourceLinkage');

/**
  * JSON:API Relationship class
  */
class Lib_Net_Api_Rest_JsonApi_Server_Relationship implements \JsonSerializable {

	/**
	 * Links object; must have self and/or related, no others; otherwise must be null
	 */
	protected $links = null;

	/**
	 * Resource linkage data; contents vary between null, a single object, or arrays of objects (possibly empty)
	 */
	protected $data = null;

	/**
	 * Meta object for non-standard metadata
	 */
	protected $meta = null;

	/**
	 * Setter for our $links property
	 *
	 * @param $links JSON:API Server Links class instance
	 *
	 * @return $this object for chaining...
	 */
	public function setLinks(Lib_Net_Api_Rest_JsonApi_Server_Links $links) {
		$this->links = $links;
	}

	/**
	 * Setter for our $data property
	 *
	 * @param $data JSON:API Server ResourceLinkage class instance
	 *
	 * @return $this object for chaining...
	 */
	public function setData(Lib_Net_Api_Rest_JsonApi_Server_ResourceLinkage $data) {
		$this->data = $data;
	}

	/**
	 * Setter for our $meta property
	 *
	 * @param $meta JSON:API Server Meta class instance
	 *
	 * @return $this object for chaining...
	 */
	public function setMeta(Lib_Net_Api_Rest_JsonApi_Server_Meta $meta) {
		$this->meta = $meta;
	}

	/**
	 * JsonSerializable Json Serializer
	 *
	 * @return Associative array of properties which will be encoded as the JSON representation
	 * of object instances of this class
	 */
	public function jsonSerialize() {
		if (! (isset($this->links) || isset($this->data) || (isset($this->meta)))) {
			throw new \Exception('At least one relationship property must be set to be valid');
		}
		return [
			'links' => $this->links,
			'data' => $this->data,
			'meta' => $this->meta
		];
	}
}

