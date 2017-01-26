<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Server_Relationships - JSON:API Relationship Collection for response documents
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Data.Collection');

/**
 * JSON:API Relationship Collection for response documents
 */
class Lib_Net_Api_Rest_JsonApi_Server_Relationships extends Lib_Data_Collection implements \JsonSerializable {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('Lib_Net_Api_Rest_JsonApi_Server_Relationship');
	}

	/**
	 * @override Collection add to make sure we don't duplicate the key
	 *
	 * @param $relationship Relationship class instance to add
	 *
	 * @return Collection position for this Relationship once added
	 *
	 * @throws exception if you try to pass null or a Relationship with a duplicate name
	 */
	public function add(Lib_Net_Api_Rest_JsonApi_Server_Relationship $relationship) {
		if (is_null($relationship)) {
			throw new \Exception('Cannot add a null entry to a Relationships collection');
		}

		// fixme: hasWith() only works to check the names of public property values; should
		// we make an interface which every "collectable" in a collection must implement to
		// be able to get access to some uniquifier?
		if ($this->hasWith('name', $relationship->getName)) {
			throw new \Exception('Relationships collection already has an entry with this name');
		}

		return parent::add($relationship);
	}

	/**
	 * JsonSerializable Json Serializer
	 *
	 * @return Associative array of properties which will be encoded as the JSON representation
	 * of object instances of this class
	 */
	public function jsonSerialize() {
		$relationships = array();
		$this->iterate(
			function ($relationship) use (&$relationships) {
				if (! isset($relationships[$relationship->getName()])) {
					$relationships[$relationship->getName()] = $relationship;
				}
			}
		);
		return $relationships;
	}
}

