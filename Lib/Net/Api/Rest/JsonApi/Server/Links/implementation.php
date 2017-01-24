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

