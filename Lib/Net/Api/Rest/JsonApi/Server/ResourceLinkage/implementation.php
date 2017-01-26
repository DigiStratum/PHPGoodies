<?php
/**
 * PHPGoodies:Lib_Net_Api_Rest_JsonApi_Server_ResourceLinkage - A resource linkage base class
 * 
 * There are two variations under JSON:API spec for Resource Linkages, so this base class will
 * allow us to make a specialized class for each variation with this super class in place to
 * hold the common code as well as provide a common ancestry point for is-a checks.
 *
 * @uses Lib_Data_Collection
 * @uses Lib_Net_Api_Rest_JsonApi_Server_ResourceIdentifier
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Data.Collection');
PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.ResourceIdentifier');

/**
 * A resource linkage base class to handle the two variations under JSON:API spec.
 */
abstract class Lib_Net_Api_Rest_JsonApi_Server_ResourceLinkage extends Lib_Data_Collection {

	/**
	 * Limit for number of Resource Identifiers (null is unlimited)
	 */
	protected $limit;

	/**
	 * Constructor
	 *
	 * @param $limit integer limit for how many Resource Identifiers we will allow to be add()ed;
	 * optional, default is null (unlimited)
	 */
	public function __construct(integer $limit = null) {
		$this->limit = $limit;
		parent::__construct('Lib_Net_Api_Rest_JsonApi_Server_ResourceIdentifier');
	}

	/**
	 * Add a Resource Identifier to our collection
	 *
	 * @param $resourceIdentifier object instance of JSON:API ResourceIdentifier class
	 *
	 * @return $this object for chaining...
	 *
	 * @throws Exception if this is an attempt to add too many objects to the collection
	 */
	public function add(Lib_Net_Api_Rest_JsonApi_Server_ResourceIdentifier $resourceIdentifier) {
		// Is there a limit in place?
		if ((! is_null($limit)) && ($this->num() >= $limit)) {
			throw new \Exception('Limit has been reached for number of Resource Identifiers added to this Resource Linkage');
		}
		$this->add($resourceIdentifier);
		return $this;
	}
}

