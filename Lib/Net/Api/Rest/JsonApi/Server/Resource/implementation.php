<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Server_Resource - Resource Data Class
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * JSON:API Resource data class
 */
class Lib_Net_Api_Rest_JsonApi_Server_Resource implements \JsonSerializable {

	/**
	 * Our unique ID (String)
	 */
	protected $id;

	/**
	 * Our data type (String)
	 */
	protected $type;

	/**
	 * Our collection of attributes
	 */
	protected $attributes;

	/**
	 * Our collection of relationships
	 */
	protected $relationships = array();

	/**
	 * Links related to this resource
	 */
	protected $links;

	/**
	 * Non-standard metadata about the resource
	 */
	protected $meta;

	/**
	 * Constructor
	 *
	 * @param $type String - we must have a resource type
	 * @param $attributes - we must have a Hash object instance for attributes
	 * @param $id string - we may optionally have a unique ID (if creating a new one, we won't!)
	 */
	public function __construct($type, $attributes, $id = null) {
		if (
			(! is_String($type)) || (strlen($type) === 0) ||
			(! is_object($attributes)) || ($attributes->num() === 0)
		) {
			throw new \Exception("Invalid type/attributes supplied: '{$type}'");
		}
		$this->type = $type;
		$this->attributes = $attributes;
		if (is_null($id) || is_string($id)) $this->id = $id;
	}

	/**
	 * Set the relationships manually if needed
	 *
	 * @param $relationships Array of resource relationship objects (if any)
	 *
	 * @return $this object to support chaining...
	 */
	public function setRelationships($relationships) {
		// FIXME: Validate that the parameter is what it purports to be!
		$this->relationships = $relationships;
		return $this;
	}

	/**
	 * Set the collection of attributes to that provided
	 *
	 * @param $attributes Attributes class instance with all the needed attributes preloaded
	 *
	 * @return $this object for chaining...
	 */
	public function setAttributes(Lib_Net_Api_Rest_JsonApi_Server_Attributes $attributes) {
		$this->attributes = $attributes;
		return $this;
	}

	/**
	 * Set the links manually if needed
	 *
	 * @param $links Links Collection object
	 *
	 * @return $this object to support chaining...
	 */
	public function setLinks(Lib_Net_Api_Rest_JsonApi_Server_Links $links) {
		$this->links = $links;
		return $this;
	}

	/**
	 * JsonSerializable Json Serializer
	 *
	 * @return Associative array of properties which will be encoded as the JSON representation
	 * of object instances of this class
	 */
	public function jsonSerialize() {
		return [
			'type': $this->type,
			'id': $this->id,
			'attributes': $this->attributes,
			'relationships': $this->relationships
		];
	}
}

