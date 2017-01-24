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
	protected $pointer;

	/**
	 * String identifying which URI parameter caused the error
	 */
	protected $parameter;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->pointer = null;
		$this->parameter = null;
	}

	/**
	 * Setter for the pointer
	 *
	 * @param $pointer String RFC6901 JSON Pointer into the offending request doument entity
	 *
	 * @return $this object for chaining...
	 */
	public function setPointer(string $pointer) {
		if (is_null($pointer) || (0 === strlen($pointer))) {
			throw new \Exception("Can't set an empty pointer for Error Source");
		}
		$this->pointer = $pointer;
		return $this;
	}

	/**
	 * Setter for the parameter
	 *
	 * @param $parameter String identifying which URI parameter caused the error
	 *
	 * @return $this object for chaining...
	 */
	public function setParameter(string $parameter) {
		if (is_null($parameter) || (0 === strlen($parameter))) {
			throw new \Exception("Can't identify an empty parameter for Error Source");
		}
		$this->parameter = $parameter;
		return $this;
	}

	public function jsonSerialize() {
		if (is_null($this->pointer) && is_null($this->parameter)) {
			throw new \Exception("Can't generate an Error Source without identifying a source");
		}
		return [
			'pointer' => $this->pointer,
			'parameter' => $this->parameter
		];
	}
}

