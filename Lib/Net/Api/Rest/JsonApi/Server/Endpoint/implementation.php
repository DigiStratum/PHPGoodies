<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Endpoint - Abstract class for a single endpoint
 *
 * @fixme Finish off this mid-level class once we're done with the low-level stuff
 *
 * @uses Lib_Data_Hash
 * @uses Lib_Net_Api_Rest_JsonApi_Server_Attribute
 * @uses Lib_Net_Api_Rest_JsonApi_Server_EndpointData
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;


/**
 * JSON:API Single endpoint base class
 *
 * Each of the abstract methods is documented with certain expectations of the subclass behavior.
 */
abstract class Lib_Net_Api_Rest_JsonApi_Server_Endpoint {

	/**
	 * Our endpoint data
	 */
	private $data;

	/**
	 * Constructor
	 *
	 * @param $type string type of endpoint we are working with
	 */
	public function __construct($type) {

		// Declare each of the attributes' names in the endpoint data
		$attributes = PHPGoodies::instantiate('Lib.Data.Hash');
		$attributeNames = $this->getAttributeNames();
		if ((! is_array($attributeNames)) || (count($attributeNames) === 0)) {
			throw new \Exception("No attribute names were supplied");
		}
		foreach ($attributeNames as $attributeName) {
			$attributes->set(
				$attributeName,
				PHPGoodies::instantiate('Lib.Net.Api.Rest.JsonApi.Server.Attribute', $attributeName)
			);
		}
		$this->data = PHPGoodies::instantiate('Lib.Net.Api.Rest.JsonApi.Server.EndpointData', $type, $attributes);
	}

	/**
	 * Gets a list of attribute names
	 */
	abstract public function getAttributeNames();

	/**
	 * Set the current data
	 */
	public function setData($data);

	/**
	 * Get the current data
	 */
	public function getData();

	/**
	 * Returns the URI, relative to the API base URL, for this endpoint
	 */
	public function getUri();

	/**
	 * Accepts endpoint data from 
	 */
	public function create();

	/**
	 *
	 */
	public function retrieve();

	/**
	 *
	 */
	public function update();

	/**
	 *
	 */
	public function delete();

	/**
	 *
	 */
	public function validate();

	/**
	 *
	 */
	public function toJson();

	/**
	 *
	 */
	public function fromJson($json);
}

