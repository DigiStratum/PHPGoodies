<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Server_Relationships - JSON:API Relationship Collection for response documents
 *
 * @uses Lib_Data_Collection_Keyed
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Data.Collection.Keyed');

/**
 * JSON:API Relationship Collection for response documents
 */
class Lib_Net_Api_Rest_JsonApi_Server_Relationships extends Lib_Data_Collection_Keyed {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('Lib_Net_Api_Rest_JsonApi_Server_Relationship');
	}
}

