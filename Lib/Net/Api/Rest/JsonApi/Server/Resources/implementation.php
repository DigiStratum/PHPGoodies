<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Server_Resources - JSON:API Resource Collection for response documents
 *
 * @uses Lib_Net_Api_Rest_JsonApi_Server_PrimaryData
 * @uses Lib_Net_Api_Rest_JsonApi_Server_Resource
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Data.Collection');
PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.PrimaryData');

/**
 * JSON:API Resource Collection for response documents
 */
class Lib_Net_Api_Rest_JsonApi_Server_Resources extends Lib_Data_Collection implements Lib_Net_Api_Rest_JsonApi_Server_PrimaryData {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct('Lib_Net_Api_Rest_JsonApi_Server_Resource');
	}
}

