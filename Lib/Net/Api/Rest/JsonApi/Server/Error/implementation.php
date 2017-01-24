<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Server_Error - JSON:API Error class for response documents
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

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
	 * Constructor
	 */
	public function __construct() {
	}

	/**
	 * Setter for ID
	 *
	 * @param $id String unique identifier for this occurrence of the problem
	 *
	 * @return $this for chaining...
	 */
	public function setId(string $id) {
		if (0 === strlen($id)) {
			throw new \Exception("Can't set an empty string as the unique ID for an Error");
		}
		$this->id = $id;
		return $this;
	}

	/**
	 * Setter for links 
	 *
	 * @param $links Links Collection instance with an 'about' link inside
	 *
	 * @return $this for chaining...
	 */
	public function setLinks(Lib_Net_Api_Rest_JsonApi_Server_Links $links) {
		if (! ($links->hasWith('name', 'about') && ($links->num() === 1))) {
			throw new \Exception("Links for Errors must have only one 'about' link");
		}
		$this->links = $links;
		return $this;
	}

	/**
	 * Setter for code
	 *
	 * @param $code String HTTP standard error code which most closely matches this error condition
	 *
	 * @return $this for chaining...
	 */
	public function setCode(string $code) {
		if (is_null($code) || (0 === strlen($code)) || (! is_numeric($code))) {
			throw new \Exception("Code must be a string formatted numeric HTTP error code");
		}
		$this->code = $code;
		return $this;
	}

	/**
	 * Setter for Title
	 *
	 * @param $title String Human readable summary of this classification of problem 
	 *
	 * @return $this for chaining...
	 */
	public function setTitle(string $title) {
		if (is_null($title) || (0 === strlen($title))) {
			throw new \Exception("Can't set an empty string as the title for an Error");
		}
		$this->title = $title;
		return $this;
	}

	/**
	 * Setter for Detail
	 *
	 * @param $detail String Human readable explanation of this specific occurrence of the problem
	 *
	 * @return $this for chaining...
	 */
	public function setDetail(string $detail) {
		if (is_null($detail) || (0 === strlen($detail))) {
			throw new \Exception("Can't set an empty string as the detail for an Error");
		}
		$this->detail = $detail;
		return $this;
	}

	/**
	 * Setter for Source
	 *
	 * @param $source Server Error Srouce class instance to describe from whence the error came
	 *
	 * @return $this for chaining...
	 */
	public function setSource(Lib_Net_Api_Rest_JsonApi_Server_Error_Source $source) {
		if (is_null($source)) {
			throw new \Exception("Can't set a null source for an Error");
		}
		$this->source = $source;
		return $this;
	}

	/**
	 * Setter for Meta
	 *
	 * @param $meta JsonApi Meta class instance to bear non-standard metadata
	 *
	 * @return $this for chaining...
	 */
	public function setMeta(Lib_Net_Api_Rest_JsonApi_Server_Meta $meta) {
		if (is_null($meta)) {
			throw new \Exception("Can't set a null meta for an Error");
		}
		$this->meta = $meta;
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

