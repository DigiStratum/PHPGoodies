<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Server_ResourceLinkage_Multiple - ResourceLinkage Multiple Class
 *
 * Establishes a collection of relationship links from a resource to many other resource identifiers
 *
 * @uses Lib_Net_Api_Rest_JsonApi_Server_ResourceLinkage
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.ResourceLinkage');

/**
 * JSON:API ResourceLinkage_Multiple class
 */
class Lib_Net_Api_Rest_JsonApi_Server_ResourceLinkage_Multiple extends Lib_Net_Api_Rest_JsonApi_Server_ResourceLinkage implements \JsonSerializable {

	/**
	 * JsonSerializable Json Serializer
	 *
	 * @return an array of objects, empty if no ResourceIdentifier was added
	 */
	public function jsonSerialize() {
		$res = array();       
		if ($this->num() > 0) {
			$this->iterate(
				function ($resourceIdentifier) use (&$res) {
					$res[] = $resourceIdentifier;
				}
			);
		}
		return array();
	}
}

