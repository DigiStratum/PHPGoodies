<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Server_Meta - JSON:API Meta class for non-standard information in documents
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Data.Hash');

/**
 * JSON:API Meta class for non-standard information in documents
 */
class Lib_Net_Api_Rest_JsonApi_Server_Meta extends Lib_Data_Hash implements \JsonSerializable {

	/**
	 * JsonSerializable Json Serializer
	 *
	 * @return Associative array of properties which will be encoded as the JSON representation
	 * of object instances of this class
	 */
	public function jsonSerialize() {
		return $this->all();
	}
}

