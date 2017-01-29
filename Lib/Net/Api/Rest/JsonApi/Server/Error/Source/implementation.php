<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Server_Error_Source - JSON:API Error Source class for response documents
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * JSON:API Error Source class for response documents
 */
class Lib_Net_Api_Rest_JsonApi_Server_Error_Source implements \JsonSerializable {

	/**
	 * JSON Pointer [RFC6901] to request document entity
	 */
	protected $ptr;

	/**
	 * String identifying which URI parameter caused the error
	 */
	protected $parameter;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->ptr = null;
		$this->parameter = null;
	}

	/**
	 * Setter for the ptr
	 *
	 * @param string $ptr RFC6901 JSON Pointer into the offending request doument entity
	 *
	 * @return object $this for chaining...
	 */
	public function setPointer(string $ptr) {
		if (is_null($ptr) || (0 === strlen($ptr))) {
			throw new \Exception("Can't set an empty ptr for Error Source");
		}
		$this->ptr = $ptr;
		return $this;
	}

	/**
	 * Setter for the parameter
	 *
	 * @param string $parameter identifies which URI parameter caused the error
	 *
	 * @return object $this for chaining...
	 */
	public function setParameter(string $parameter) {
		if (is_null($parameter) || (0 === strlen($parameter))) {
			throw new \Exception("Can't identify an empty parameter for Error Source");
		}
		$this->parameter = $parameter;
		return $this;
	}

	/**
	 * JsonSerializable Json Serializer
	 *
	 * @return Associative array of properties which will be encoded as the JSON representation
	 * of object instances of this class
	 */
	public function jsonSerialize() {
		if (is_null($this->ptr) && is_null($this->parameter)) {
			throw new \Exception("Can't generate an Error Source without identifying a source");
		}
		return [
			'pointer' => $this->ptr,
			'parameter' => $this->parameter
		];
	}
}

