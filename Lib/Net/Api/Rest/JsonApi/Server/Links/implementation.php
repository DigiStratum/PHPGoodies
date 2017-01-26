<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Server_Links - JSON:API Link Collection for response documents
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Data.Collection');

/**
 * JSON:API Link Collection for response documents
 */
class Lib_Net_Api_Rest_JsonApi_Server_Links extends Lib_Data_Collection implements \JsonSerializable {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('Lib_Net_Api_Rest_JsonApi_Server_Link');
	}

	/**
	 * @override Collection add to make sure we don't duplicate the key
	 *
	 * @param $link Link class instance to add
	 *
	 * @return Collection position for this Link once added
	 *
	 * @throws exception if you try to pass null or a Link with a duplicate name
	 */
	public function add(Lib_Net_Api_Rest_JsonApi_Server_Link $link) {
		if (is_null($link)) {
			throw new \Exception('Cannot add a null entry to a Links collection');
		}

		// fixme: hasWith() only works to check the names of public property values; should
		// we make an interface which every "collectable" in a collection must implement to
		// be able to get access to some uniquifier?
		if ($this->hasWith('name', $link->getName)) {
			throw new \Exception('Links collection already has an entry with this name');
		}

		return parent::add($link);
	}

	/**
	 * JsonSerializable Json Serializer
	 *
	 * @return Associative array of properties which will be encoded as the JSON representation
	 * of object instances of this class
	 */
	public function jsonSerialize() {
		$links = array();
		$this->iterate(
			function ($link) use (&$links) {
				if (! isset($links[$link->getName()])) {
					$links[$link->getName()] = $link;
				}
			}
		);
		return $links;
	}
}

