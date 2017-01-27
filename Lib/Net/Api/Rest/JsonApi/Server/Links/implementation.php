<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Server_Links - JSON:API Link Collection for response documents
 *
 * @uses Lib_Data_Collection_Keyed
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Data.Collection.Keyed');

/**
 * JSON:API Link Collection for response documents
 */
class Lib_Net_Api_Rest_JsonApi_Server_Links extends Lib_Data_Collection_Keyed implements \JsonSerializable {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('Lib_Net_Api_Rest_JsonApi_Server_Link');
	}
}

