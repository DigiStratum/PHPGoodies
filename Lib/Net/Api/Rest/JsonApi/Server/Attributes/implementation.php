<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Server_Attributes - JSON:API Attribute Collection for response documents
 *
 * @uses Lib_Data_Collection_Keyed
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Data.Collection.Keyed');

/**
 * JSON:API Attribute Collection for response documents
 */
class Lib_Net_Api_Rest_JsonApi_Server_Attributes extends Lib_Data_Collection_Keyed {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('Lib_Net_Api_Rest_JsonApi_Server_Attribute');
	}

	/**
	 * @override Add a name/value pair as an attribute to the collection
	 *
	 * @param string $name name of the attribute
	 * @param mixed $value value of the attribute; optional, default is null
	 *
	 * @return object $this for chaining...
	 */
	public function add($name, $value = null) {
		parent::add(PHPGoodies::instantiate('Lib_Net_Api_Rest_JsonApi_Server_Attribute', $name, $value));
		return $this;
	}
}

