<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Server_Attributes - JSON:API Attribute Collection for response documents
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Data.Collection');

/**
 * JSON:API Attribute Collection for response documents
 */
class Lib_Net_Api_Rest_JsonApi_Server_Attributes extends Lib_Data_Collection implements \JsonSerializable {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('Lib_Net_Api_Rest_JsonApi_Server_Attribute');
	}

	/**
	 * @override Add the name/value pair as an attribute to the collection
	 *
	 * @param $name String name of the attribute
	 * @param $value Mixed value of the attribute; optionsal, default is null
	 *
	 * @return $this object for chaining...
	 */
	public function add($name, $value = null) {
		parent::add(PHPGoodies::instantiate('Lib_Net_Api_Rest_JsonApi_Server_Attribute', $name, $value));
		return $this;
	}

	/**
	 * Delete the named attribute from the collection
	 *
	 * Note: there's no error for attempting to delete a non-existent attribute; you wanted it
	 * to be not there and, well, it's not there, so what's the problem? :)
	 *
	 * @param $name String name of the attribute to delete
	 *
	 * @return $this object for chaining...
	 */
	public function del($name) {
		$index = $this->findIndex('getName', $name);
		if (! is_null($index)) {
			parent::del($index);
		}
		return $this;
	}

	/**
	 * JsonSerializable Json Serializer
	 *
	 * @return Associative array of properties which will be encoded as the JSON representation
	 * of object instances of this class
	 */
	public function jsonSerialize() {
		$attributes = array();
		$this->iterate(
			function ($attribute) use (&$attributes) {
				if (! isset($attributes[$attribute->getName()])) {
					$attributes[$attribute->getName()] = $attribute->getValue();
				}
			}
		);
		return $attributes;
	}
}

