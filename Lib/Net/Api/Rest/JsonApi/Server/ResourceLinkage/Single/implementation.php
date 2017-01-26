<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Server_ResourceLinkage_Single - ResourceLinkage Single Class
 *
 * Establishes a relationship link from a resource to one other resource identifier.
 *
 * @uses Lib_Net_Api_Rest_JsonApi_Server_ResourceLinkage
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.ResourceLinkage');

/**
 * JSON:API ResourceLinkage_Single class
 */
class Lib_Net_Api_Rest_JsonApi_Server_ResourceLinkage_Single extends Lib_Net_Api_Rest_JsonApi_Server_ResourceLinkage implements \JsonSerializable {

	/**
	 * Constructor
	 */
	public function __construct() {

		// Set the limit to 1 for single resource identifier support
		parent::__construct(1);
	}

	/**
	 * JsonSerializable Json Serializer
	 *
	 * @return a single object, or null if no ResourceIdentifier was added
	 */
	public function jsonSerialize() {
		// Zero items is null; One item is returned directly
		return ($this->num() == 0) ? null : $this->get(0);
	}
}

