<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Resource - Abstract class for a single resource
 *
 * @uses Lib_Data_Hash
 * @uses Lib_Net_Api_Rest_JsonApi_Server_Attribute
 * @uses Lib_Net_Api_Rest_JsonApi_Server_ResourceData
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;


/**
 * JSON:API Single resource base class
 *
 * Each of the abstract methods is documented with certain expectations of the subclass behavior.
 */
abstract class Lib_Net_Api_Rest_JsonApi_Resource {

	/**
	 * Our resource data
	 */
	private $data;

	/**
	 * Constructor
	 *
	 * @param $type string type of resource we are working with
	 */
	public function __construct($type) {

		// Declare each of the attributes' names in the resource data
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
		$this->data = PHPGoodies::instantiate('Lib.Net.Api.Rest.JsonApi.Server.ResourceData', $type, $attributes);
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
	 * Returns the URI, relative to the API base URL, which will deliver this exact resource
	 */
	public function getUri();

	/**
	 * Accepts resource data from 
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

