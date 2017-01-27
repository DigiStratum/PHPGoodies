<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Server_Attribute - Resource Attribute class
 *
 * @uses Lib_Net_Api_Rest_JsonApi_Server_Member
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.Member');

/**
 * JSON:API Resource attribute class
 */
class Lib_Net_Api_Rest_JsonApi_Server_Attribute implements Lib_Data_Collection_Keyed_Item {

	/**
	 * Our attribute name
	 */
	protected $name = null;

	/**
	 * Our attribute current value
	 */
	protected $value = null;

	/**
	 * Constructor
	 *
	 * @param $name String name of the attribute
	 * @param $value Mixed value for the attribute; optional, default is null
	 */
	public function __construct(string $name, $value = null) {
		if (! Lib_Net_Api_Rest_JsonApi_Server_Member::isValidMemberName($name)) {
			throw new \Exception("Invalid attribute name supplied: '{$name}'");
		}
		$this->name = $name;
		$this->value = $value;
	}

	/**
	 * For Lib_Data_Collection_Keyed_Item interface...
	 */
	public function getKey() {
		return $this->name;
	}

	/**
	 * Set the current value for the attribute
	 *
	 * @param $value mixed value for the attribute; optional, default is null
	 *
	 * @return $this object for chaining...
	 */
	public function setValue($value = null) {
		$this->value = $value;
		return $this;
	}

	/**
	 * Get the current value for the attribute
	 *
	 * @return mixed value last set for the attribute
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * JsonSerializable Json Serializer
	 *
	 * @return stirng value of the attribute; the name will be picked up in Collection iterator
	 */
	public function jsonSerialize() {
		return $this->value;
	}
}

