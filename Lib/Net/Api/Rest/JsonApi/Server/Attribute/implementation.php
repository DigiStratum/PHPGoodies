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
class Lib_Net_Api_Rest_JsonApi_Server_Attribute {

	/**
	 * Our attribute name
	 */
	private $name = null;

	/**
	 * Our attribute current value
	 */
	private $value = null;

	/**
	 * Constructor
	 */
	public function __construct($name, $value = null) {
		if (! Lib_Net_Api_Rest_JsonApi_Server_Member::isValidMemberName($name)) {
			throw new \Exception("Invalid attribute name supplied: '{$name}'");
		}
		$this->name = $name;
		$this->value = $value;
	}

	/**
	 * Get the name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Set the current value
	 */
	public function setValue($value) {
		$this->value = $value;
	}

	/**
	 * Get the current data
	 */
	public function getValue() {
		return $this->value;
	}
}

