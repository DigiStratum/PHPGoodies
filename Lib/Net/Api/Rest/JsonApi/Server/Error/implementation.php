<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Server_Error - JSON:API Error class for response documents
 *
 * @uses Oop_Type
 * @uses Lib_Net_Api_Rest_JsonApi_Server_Links
 * @uses Lib_Net_Api_Rest_JsonApi_Server_Meta
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Oop.Type');
PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.Error.Source');
PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.Meta');

/**
 * JSON:API Error class for response documents
 */
class Lib_Net_Api_Rest_JsonApi_Server_Error implements \JsonSerializable {

	/**
	 * A unique identifier for this specific occurrence of the problem
	 */
	protected $id;

	/**
	 * A links collection with only an "about" link present
	 */
	protected $links;

	/**
	 * HTTP status code for this problem (maybe useful if multiple errors of varying HTTP-equivalent codes)
	 */
	protected $status;

	/**
	 * Applicatoin specific error code
	 */
	protected $code;

	/**
	 * Human readable summary of this classification of problem
	 */
	protected $title;

	/**
	 * Human readable explanation of this specific occurrence of the problem
	 */
	protected $detail;

	/**
	 * References to the source of the error
	 */
	protected $source;

	/**
	 * Non-standard metadata about the problem
	 */
	protected $meta;

	/**
	 * Setter for ID
	 *
	 * @param string $id unique identifier for this occurrence of the problem
	 *
	 * @return object $this for chaining...
	 */
	public function setId($id) {
		$this->id = Oop_Type::requireType($id, 'string');
		if (0 === strlen($id)) {
			throw new \Exception("Can't set an empty string as the unique ID for an Error");
		}
		return $this;
	}

	/**
	 * Setter for links 
	 *
	 * @param object $links Links Collection instance with an 'about' link inside
	 *
	 * @return object $this for chaining...
	 */
	public function setLinks($links) {
		Oop_Type::requireType($links, 'class:Lib_Net_Api_Rest_JsonApi_Server_Links');
		if (! ($links->has('about') && ($links->num() === 1))) {
			throw new \Exception("Links for Errors must have only one 'about' link");
		}
		$this->links = $links;
		return $this;
	}

	/**
	 * Setter for code
	 *
	 * @param String $code HTTP standard error code which most closely matches this error condition
	 *
	 * @return object $this for chaining...
	 */
	public function setCode($code) {
		Oop_Type::requireType($code, 'string');
		if ((0 === strlen($code)) || (! is_numeric($code))) {
			throw new \Exception("Code must be a string formatted numeric HTTP error code");
		}
		$this->code = $code;
		return $this;
	}

	/**
	 * Setter for Title
	 *
	 * @param String $title Human readable summary of this classification of problem 
	 *
	 * @return object $this for chaining...
	 */
	public function setTitle($title) {
		Oop_Type::requireType($title, 'string');
		if (0 === strlen($title)) {
			throw new \Exception("Can't set an empty string as the title for an Error");
		}
		$this->title = $title;
		return $this;
	}

	/**
	 * Setter for Detail
	 *
	 * @param String $detail Human readable explanation of this specific occurrence of the problem
	 *
	 * @return object $this for chaining...
	 */
	public function setDetail($detail) {
		Oop_Type::requireType($detail, 'string');
		if (is_null($detail) || (0 === strlen($detail))) {
			throw new \Exception("Can't set an empty string as the detail for an Error");
		}
		$this->detail = $detail;
		return $this;
	}

	/**
	 * Setter for Source
	 *
	 * @param Source $source Server Error Srouce class instance to describe from whence the error came
	 *
	 * @return object $this for chaining...
	 */
	public function setSource($source) {
		$this->source = Oop_Type::requireType($source, 'class:Lib_Net_Api_Rest_JsonApi_Server_Source');
		return $this;
	}

	/**
	 * Setter for Meta
	 *
	 * @param object $meta Meta class instance to bear non-standard metadata
	 *
	 * @return object $this for chaining...
	 */
	public function setMeta($meta) {
		$this->meta = Oop_Type::requireType($meta, 'class:Lib_Net_Api_Rest_JsonApi_Server_Meta');
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
			'id' => $this->id,
			'links' => $this->links,
			'status' => $this->status,
			'code' => $this->code,
			'title' => $this->title,
			'detail' => $this->detail,
			'source' => $this->source,
			'meta' => $this->meta
		];
	}
}

